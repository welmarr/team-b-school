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
     * This method checks the authentication status and role of the user,
     * and performs the following actions:
     * 1. If the user is not authenticated, redirects to the login page.
     * 2. If the user is authenticated but hasn't completed initial setup:
     *    - For admin users, redirects to the initial setup view.
     *    - For non-admin users, updates the first_connect_at timestamp.
     * 3. If the user is authenticated and has completed initial setup:
     *    - Checks if the user is accessing an authorized page based on their role.
     *    - If not, redirects to the login page with a warning message.
     *
     * @param  \Illuminate\Http\Request  $request  The incoming HTTP request
     * @param  \Closure  $next  The next middleware in the pipeline
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        $messageForRedirectTo = null;
        $typeOfMessageForRedirectTo = null;
        $redirectTo = null;
        // Verify if the user is authenticated
        if (Auth::check()) {
            $user = Auth::user();

            // Verify if the user has completed the initial setup
            if ($user->first_connect_at === null) {
                // Handle users who haven't completed the initial setup
                if ($user->role === "admin") {
                    // Redirect admin users to the initial setup view
                    $messageForRedirectTo = 'For security reasons, please change your password.';
                    $typeOfMessageForRedirectTo = 'warning';
                    $redirectTo = 'secured.admin.initialSetupView';
                } else {
                    // Update first_connect_at for non-admin users
                    \App\Models\User::where('id', $user->id)->update(['first_connect_at' => \Carbon\Carbon::now()]);
                }
            } else {
                // Verify if the user is accessing an authorized page
                $isAuthorizedAccess = ($user->role === "admin" && $request->is('*secured/admins*')) ||
                    ($user->role !== "admin" && $request->is('*secured/dealers-customers*'));

                if (!$isAuthorizedAccess) {
                    // Redirect to login if accessing an unauthorized page
                    $messageForRedirectTo = 'You are trying to access an unauthorized page. Please log in again.';
                    $typeOfMessageForRedirectTo = 'warning';
                    $redirectTo = 'login';
                }
            }
        } else {
            // Redirect unauthenticated users to the login page
            $messageForRedirectTo = 'Sorry, you need to log in to access this page.';
            $typeOfMessageForRedirectTo = 'error';
            $redirectTo = 'login';
        }

        if ($redirectTo) {
            return redirect()->route($redirectTo)->with($typeOfMessageForRedirectTo, $messageForRedirectTo);
        }

        // Proceed with the request if all checks pass
        return $next($request);
    }

}
