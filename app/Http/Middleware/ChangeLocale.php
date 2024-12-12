<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class ChangeLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->wantsJson() && $request->hasHeader('Accept-Language')) {
            App::setLocale($request->header('Accept-Language'));
        }

        if (session()->has('locale')) {
            App::setLocale(session('locale'));
        }

        return $next($request);
    }
}
