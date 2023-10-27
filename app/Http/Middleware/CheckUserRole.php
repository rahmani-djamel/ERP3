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
        return $next($request);

        if (Auth::check()) {
            $user = Auth::user();
            $employee = $user->employee;

            //dd($employee->roleCheck());
            //dd($employee);

         //   dd($employee->roleCheck());
         

            // Check if the user is an administrator
            if ($employee->roleCheck()) 
            {
                if (Route::has($request->route()->getName()) && Str::startsWith($request->route()->getName(), 'employee.dashboard.')) {
                    return abort(403, 'USER DOES NOT HAVE ANY OF THE NECESSARY ACCESS RIGHTS.');
                } 

                if ($user->hasPermission($permissionName)) {
                    return $next($request);
                }
                return abort(403, 'USER DOES NOT HAVE ANY OF THE NECESSARY ACCESS RIGHTS.');

            }
            //dd($employee);

            // Check if the user is an employee
            if (!$employee->roleCheck()) {
                  // Check if the current route exists and its name starts with "employee.dashboard."
                  if (Route::has($request->route()->getName()) && Str::startsWith($request->route()->getName(), 'employee.dashboard.')) {
                    return $next($request);
                } else {
                    // Abort with a 403 response if the route does not match
                    return abort(403, 'USER DOES NOT HAVE ANY OF THE NECESSARY ACCESS RIGHTS.');
                }
            }
        }

        // If the user's role does not match, return a 403 response
        return abort(403, 'USER DOES NOT HAVE ANY OF THE NECESSARY ACCESS RIGHTS.');
    }
}
