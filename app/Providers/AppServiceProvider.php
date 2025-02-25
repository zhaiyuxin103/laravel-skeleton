<?php

declare(strict_types=1);

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Lab404\Impersonate\Events\LeaveImpersonation;
use Lab404\Impersonate\Events\TakeImpersonation;
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
            'avatar' => $user->getFirstMediaUrl('avatar'),
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

        // Build out the impersonation event listeners - Otherwise we get a redirect to login if not setting the password_hash_sanctum when using sanctum.
        Event::listen(function (TakeImpersonation $event) {
            session()->put([
                'password_hash_sanctum' => $event->impersonated->getAuthPassword(),
            ]);
        });

        Event::listen(function (LeaveImpersonation $event) {
            session()->remove('password_hash_web');
            session()->put([
                'password_hash_sanctum' => $event->impersonator->getAuthPassword(),
            ]);
            Auth::setUser($event->impersonator);
        });

        // Skip for console commands
        if (config('database.default') === 'mysql' && ! App::runningInConsole()) {
            // Disable ONLY_FULL_GROUP_BY if it is enabled
            DB::statement("SET sql_mode=(SELECT REPLACE(@@sql_mode, 'ONLY_FULL_GROUP_BY', ''))");
        }

        if (! App::runningInConsole()) {
            Cache::put('thumbnail', [128, 256, 512, 1024]);
        }
    }
}
