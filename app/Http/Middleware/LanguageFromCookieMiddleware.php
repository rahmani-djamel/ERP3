<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Symfony\Component\HttpFoundation\Response;

class LanguageFromCookieMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $local = Cookie::get('lang') ?: config('app.locale');

        App::setLocale($local);

        //config()->set('direction', Cookie::get('direction') ? 'rtl' : 'ltr');


        

        config()->set('direction', Cookie::get('direction') ? Cookie::get('direction') : 'rtl');

        //dd(config('direction'),Cookie::get('direction'));

           return $next($request);
    }
}
