<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Response;

class ShareDataMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Create the variable or object you want to share
        $sharedData = (object) [
            'resource' => 'users',
            'permissions' => ['create', 'edit', 'delete'],
            'siteName' => 'My Awesome Site',
        ];

        $newUser = \App\Models\User::whereNull('first_connect_at')->count();

        // Share the data with all views
        View::share(['newUser' => $newUser]);

        return $next($request);
    }
}
