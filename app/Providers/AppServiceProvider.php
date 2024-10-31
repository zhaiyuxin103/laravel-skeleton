<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Laravel\Pulse\Facades\Pulse;
use Opcodes\LogViewer\Facades\LogViewer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        LogViewer::auth(function ($request) {
            return $request->user()
                && in_array($request->user()->email, [
                    'zhaiyuxin103@hotmail.com',
                ]);
        });

        Gate::define('viewPulse', function (User $user) {
            return $user->isAdmin() && in_array($user->email, [
                'zhaiyuxin103@hotmail.com',
            ]);
        });

        Pulse::user(fn ($user) => [
            'name'   => $user->name,
            'extra'  => $user->email,
            'avatar' => $user->full_avatar,
        ]);

        Pulse::handleExceptionsUsing(function ($e) {
            Log::debug('An exception happened in Pulse', [
                'message' => $e->getMessage(),
                'stack'   => $e->getTraceAsString(),
            ]);
        });

        if (config('app.https')) {
            URL::forceScheme('https');
        }
    }
}
