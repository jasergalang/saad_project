<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {
            // Check if the user is authenticated
        if (!$request->user()) {
            return redirect()->back()->with('error', 'You must be logged in to access this resource.');
        }

        // Check if the user has the specified role
        if ($request->user()->role === $role) {
            return $next($request);
        }

        // Customize the error message  based on the role
        $errorMessage = 'Unauthorized access';

        if ($role !== 'owner' && $request->user()->role !== 'owner') {
            $errorMessage = 'You must be an owner to access this resource.';
        } elseif ($role !== 'admin' && $request->user()->role !== 'admin') {
            $errorMessage = 'You must be an administrator to access this resource.';
        } elseif ($role !== 'tenant' && $request->user()->role !== 'tenant') {
            $errorMessage = 'You must be a tenant to access this resource.';
        }

        // Redirect back with an error message
        return redirect()->back()->with('error', $errorMessage);

    }



}
