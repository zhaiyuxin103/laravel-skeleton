<?php

declare(strict_types=1);

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Session\Middleware\StartSession;
use RalphJSmit\Livewire\Urls\Middleware\LivewireUrlsMiddleware;
use Sentry\Laravel\Integration;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
        then: function () {
            Route::domain(config('api.domain'))
                ->prefix(config('api.prefix'))
                ->middleware('api')
                ->group(base_path('routes/api.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(
            append: [
                App\Http\Middleware\ChangeLocale::class,
            ],
            prepend: [
                App\Http\Middleware\AcceptHeader::class,
            ]
        );
        $middleware->web(append: [
            LivewireUrlsMiddleware::class,
            StartSession::class,
            App\Http\Middleware\ChangeLocale::class,
        ]);
        $middleware->trustProxies(at: '*');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        Integration::handles($exceptions);
    })->create();
