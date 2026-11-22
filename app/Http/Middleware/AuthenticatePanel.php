<?php

namespace App\Http\Middleware;

use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Filament\Http\Middleware\Authenticate as BaseAuthenticate;
use Illuminate\Database\Eloquent\Model;

class AuthenticatePanel extends BaseAuthenticate
{
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

        if ($user instanceof FilamentUser && ! $user->canAccessPanel($panel)) {
            // Pengguna sedang login dengan peran (role) yang berbeda.
            // Logout sesi saat ini dan arahkan ke halaman login panel ini agar tidak terjadi 403 Forbidden.
            $guard->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            $this->unauthenticated($request, $guards);

            return;
        }

        abort_if(
            ! ($user instanceof FilamentUser) && config('app.env') !== 'local',
            403,
        );
    }
}

