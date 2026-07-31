<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = session('locale', config('app.locale', 'en'));

        if (! in_array($locale, ['en', 'hi'], true)) {
            $locale = 'en';
        }

        // Keep English as the HTML source language so the whole page
        // (including DB content) can be machine-translated to Hindi.
        App::setLocale('en');
        View::share('displayLocale', $locale);

        /** @var Response $response */
        $response = $next($request);

        return $response;
    }
}
