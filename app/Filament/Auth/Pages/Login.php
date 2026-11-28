<?php

namespace App\Filament\Auth\Pages;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\MultiFactor\Contracts\HasBeforeChallengeHook;
use Filament\Auth\MultiFactor\Contracts\MultiFactorAuthenticationProvider;
use Filament\Auth\Pages\Login as BaseLogin;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Timebox;
use Illuminate\Validation\ValidationException;

class Login extends BaseLogin
{
    /**
     * Override view dengan tampilan login kustom mobile-first.
     */
    protected string $view = 'vendor.filament-panels.auth.pages.login';

    public function hasLogo(): bool
    {
        return false;
    }

    public function getHeading(): string|Htmlable|null
    {
        return null;
    }

    public function getSubheading(): string|Htmlable|null
    {
        return null;
    }

    public function mount(): void
    {
        if (Filament::auth()->check()) {
            $user = Filament::auth()->user();
            $userRole = $user->role instanceof \App\Enums\UserRole 
                ? $user->role->value 
                : (string) ($user->role?->value ?? $user->role);

            $targetPanelId = match ($userRole) {
                'developer' => 'developer',
                'tester'    => 'tester',
                'admin'     => 'admin',
                default     => null,
            };

            if ($targetPanelId) {
                $targetPanel = Filament::getPanel($targetPanelId);
                $intendedUrl = session()->get('url.intended');
                if ($intendedUrl) {
                    $targetPath = '/' . $targetPanel->getPath();
                    $intendedPath = parse_url($intendedUrl, PHP_URL_PATH) ?? '';
                    if (str_starts_with($intendedPath, $targetPath)) {
                        session()->forget('url.intended');
                        redirect()->to($intendedUrl);
                        return;
                    }
                }
                session()->forget('url.intended');
                redirect()->to($targetPanel->getUrl());
                return;
            }
        }

        $this->form->fill();
    }

    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        /** @var SessionGuard $authGuard */
        $authGuard = Filament::auth();

        $authProvider = $authGuard->getProvider();
        $credentials = $this->getCredentialsFromFormData($data);
        $remember = $data['remember'] ?? false;
        $timeboxDuration = (int) config('auth.timebox_duration', 200_000);

        $user = app(Timebox::class)->call(function (Timebox $timebox) use ($authProvider, $authGuard, $credentials, $remember): Authenticatable {
            $this->fireAttemptingEvent($authGuard, $credentials, $remember);

            $user = $authProvider->retrieveByCredentials($credentials);

            if ((! $user) || (! $authProvider->validateCredentials($user, $credentials))) {
                $this->userUndertakingMultiFactorAuthentication = null;

                $this->fireFailedEvent($authGuard, $user, $credentials);
                $this->throwFailureValidationException();
            }

            $timebox->returnEarly();

            return $user;
        }, $timeboxDuration);

        $needsMultiFactorChallenge = app(Timebox::class)->call(function (Timebox $timebox) use ($user): bool {
            if (
                filled($this->userUndertakingMultiFactorAuthentication) &&
                (decrypt($this->userUndertakingMultiFactorAuthentication) === $user->getAuthIdentifier())
            ) {
                if ($this->isMultiFactorChallengeRateLimited($user)) {
                    return true;
                }

                $this->multiFactorChallengeForm->validate();

                return false;
            }

            foreach (Filament::getMultiFactorAuthenticationProviders() as $multiFactorAuthenticationProvider) {
                if (! $multiFactorAuthenticationProvider->isEnabled($user)) {
                    continue;
                }

                $this->userUndertakingMultiFactorAuthentication = encrypt($user->getAuthIdentifier());

                if ($multiFactorAuthenticationProvider instanceof HasBeforeChallengeHook) {
                    $multiFactorAuthenticationProvider->beforeChallenge($user);
                }

                break;
            }

            if (filled($this->userUndertakingMultiFactorAuthentication)) {
                $this->multiFactorChallengeForm->fill();

                return true;
            }

            return false;
        }, $timeboxDuration);

        if ($needsMultiFactorChallenge) {
            return null;
        }

        // Cek apakah akun diblokir/banned
        if ($user->is_banned) {
            throw ValidationException::withMessages([
                'data.email' => __('Akun Anda dinonaktifkan: :reason', ['reason' => $user->banned_reason ?? 'Pelanggaran ketentuan']),
            ]);
        }

        $userRole = $user->role instanceof \App\Enums\UserRole 
            ? $user->role->value 
            : (string) ($user->role?->value ?? $user->role);

        $targetPanelId = match ($userRole) {
            'developer' => 'developer',
            'tester'    => 'tester',
            'admin'     => 'admin',
            default     => null,
        };

        if (! $targetPanelId) {
            $this->fireFailedEvent($authGuard, $user, $credentials);
            $this->throwFailureValidationException();
        }

        // Login pengguna
        $authGuard->login($user, $remember);
        session()->regenerate();

        $targetPanel = Filament::getPanel($targetPanelId);
        $targetUrl = $targetPanel->getUrl();

        // Validasi url.intended: hanya arahkan ke url.intended jika URL tersebut
        // benar-benar berada dalam cakupan panel yang diizinkan untuk peran akun ini.
        $intendedUrl = session()->get('url.intended');
        if ($intendedUrl) {
            $targetPath = '/' . $targetPanel->getPath();
            $intendedPath = parse_url($intendedUrl, PHP_URL_PATH) ?? '';
            if (str_starts_with($intendedPath, $targetPath)) {
                session()->forget('url.intended');
                $this->redirect($intendedUrl);
                return null;
            }
        }

        // Hapus url.intended yang salah agar tidak meracuni navigasi
        session()->forget('url.intended');
        $this->redirect($targetUrl);
        return null;
    }
}
