<?php

namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Filament\Http\Middleware\Authenticate as BaseAuthenticate;
use Illuminate\Database\Eloquent\Model;

class AuthenticatePanel extends BaseAuthenticate
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, \Closure $next, ...$guards)
    {
        $guard = Filament::auth();

        if ($guard->check()) {
            /** @var Model $user */
            $user = $guard->user();
            $panel = Filament::getCurrentOrDefaultPanel();

            if ($user instanceof FilamentUser && ! $user->canAccessPanel($panel)) {
                // Pengguna sedang login dengan peran berbeda (misal Developer mengakses panel Tester)
                $userRole = $user->role instanceof \App\Enums\UserRole 
                    ? $user->role->value 
                    : (string) ($user->role?->value ?? $user->role);

                $correctPanelId = match ($userRole) {
                    'developer' => 'developer',
                    'tester'    => 'tester',
                    'admin'     => 'admin',
                    default     => null,
                };

                if ($correctPanelId && $correctPanelId !== $panel->getId()) {
                    // Bersihkan url.intended yang salah agar tidak redirect ke panel yang tidak berhak
                    $request->session()->forget('url.intended');
                    return redirect()->to(Filament::getPanel($correctPanelId)->getUrl());
                }

                $guard->logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->to(Filament::getLoginUrl());
            }
        }

        $this->authenticate($request, $guards);

        return $next($request);
    }

    /**
     * @param  array<string>  $guards
     */
    protected function authenticate($request, array $guards): void
    {
        $guard = Filament::auth();

        if (! $guard->check()) {
            $this->unauthenticated($request, $guards);

            return;
        }

        $this->auth->shouldUse(Filament::getAuthGuard());

        /** @var Model $user */
        $user = $guard->user();

        $panel = Filament::getCurrentOrDefaultPanel();

        abort_if(
            ! ($user instanceof FilamentUser) && config('app.env') !== 'local',
            403,
        );
    }
}

