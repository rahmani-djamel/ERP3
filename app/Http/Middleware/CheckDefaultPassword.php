<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckDefaultPassword
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

    // dd( Auth::user()->hasDefaultPassword());
        if (Auth::check() && Auth::user()->hasDefaultPassword()) 
        {
            // Replace 'hasDefaultPassword()' with your actual logic to check if the user has the default password.
            return redirect()->route('company.dashboard.password.index'); // Redirect to the password change page.
        }
        return $next($request);
    }
}
