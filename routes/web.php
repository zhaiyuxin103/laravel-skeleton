<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

Route::domain(config('app.url'))->group(function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Route::middleware([
        'auth:sanctum',
        config('jetstream.auth_session'),
        'verified',
    ])->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');
    });

    Route::get('/debug-sentry', function () {
        throw new Exception('My first Sentry error!');
    });

    Route::impersonate();

    Route::get('landing', App\Livewire\Landing::class)->name('landing');
    Route::get('about', App\Livewire\About::class)->name('about');
    Route::get('privacies', App\Livewire\Privacy::class)->name('privacies');
    Route::get('terms', App\Livewire\Term::class)->name('terms');
});
