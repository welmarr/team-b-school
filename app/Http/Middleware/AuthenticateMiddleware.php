<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated, has the role of 'admin' or 'dealer',
        // and has not yet completed the initial setup (first_connect_at is null).
        if (Auth::check() && (Auth::user()->role == "admin" || Auth::user()->role == "dealer") && Auth::user()->first_connect_at == null) {
            // Redirect to the initial setup view if the above conditions are met.
            return redirect()->route("secured.admin.initialSetupView");
        }

        // Continue to the next middleware or the requested resource.
        return $next($request);
    }
}
