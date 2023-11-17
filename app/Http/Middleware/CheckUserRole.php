<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;


class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next,$permissionName): Response
    {
       // return $next($request);

        if (Auth::check()) {
            $user = Auth::user();
            $employee = $user->employee;

            if ( $user->hasRole('manger')) 
            {
                if (Route::has($request->route()->getName()) && Str::startsWith($request->route()->getName(), 'company.dashboard.')) {
                    return $next($request);
                }
                else{
                    return abort(403, 'USER DOES NOT HAVE ANY OF THE NECESSARY ACCESS RIGHTS.');
                }
            }
            if ( $user->hasRole('administrative')) 
            {
                if (Route::has($request->route()->getName()) && Str::startsWith($request->route()->getName(), 'company.dashboard.') && $user->hasPermission($permissionName)) {
                    return $next($request);
                }
                else{
                    return abort(403, 'USER DOES NOT HAVE ANY OF THE NECESSARY ACCESS RIGHTS.');
                }
            }
            if ( $user->hasRole('owner')) 
            {
                if (Route::has($request->route()->getName()) && Str::startsWith($request->route()->getName(), 'owner.dashboard.')) {
                    return $next($request);
                }

            }

            if ( $user->hasRole('employee')) 
            {
                if (Route::has($request->route()->getName()) && Str::startsWith($request->route()->getName(), 'employee.dashboard.')) {
                    return $next($request);
                }

            }
        }

        // If the user's role does not match, return a 403 response
        return abort(403, 'USER DOES NOT HAVE ANY OF THE NECESSARY ACCESS RIGHTS.');
    }
}
