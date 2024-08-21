<?php

namespace App\Http\Controllers\Unsecured;

use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Unsecured\LoginRequest;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Handle the login process.
     *
     * This method attempts to authenticate the user, performs various checks,
     * and redirects the user based on their role and account status.
     *
     * @param LoginRequest $request The validated login request
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException If authentication fails
     */
    public function submit(LoginRequest $request)
    {
        try {
            // The request is already validated by LoginRequest
            $validated = $request->validated();

            // Attempt to authenticate the user
            if (!Auth::attempt($validated)) {
                throw ValidationException::withMessages([
                    'email' => [trans('auth.failed')],
                ]);
            }

            // If the user is authenticated, proceed with further checks
            $user = Auth::user();
            $error = null;



            if (is_null($user->email_verified_at)) {
                Auth::logout();
                $error = 'Your email address is not verified. Please check your inbox for the verification email sent when your account was created.';
            } elseif (!$user->is_active) {
                Auth::logout();
                $error = 'Your account is currently inactive. Please contact support for further assistance.';
            } else {
                // Determine the redirect route based on the user's role and first connection status


                // Determine if the user needs to be redirected to the initial setup view or the dashboard
                    if($user->role == 'admin'){
                        $roleBasedRoutes = [
                                'dashboard' => 'secured.admin.dashboard',
                                'initialSetup' => 'secured.admin.initialSetupView',
                        ];
                        $redirectRoute = is_null($user->first_connect_at)
                        ? $roleBasedRoutes['initialSetup']
                        : $roleBasedRoutes['dashboard'];
                    }else{
                        if(is_null($user->first_connect_at)){
                            $user->email_verified_at = \Carbon\Carbon::now();
                            $user->save();
                        }
                        $redirectRoute = 'secured.dealers.dashboard';
                    }

                // Regenerate session and redirect
                $request->session()->regenerate();
            }



            // If there was an error, redirect back with the error message
            return $error != null ? redirect()->back()->with('error', $error)->withInput() : redirect()->route($redirectRoute);
        } catch (ValidationException $e) {
            // Redirect back to the login form with validation errors
            return redirect()->back()->with('error', $e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle any other exceptions that may occur
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again. [' .  $e->getMessage() . "]")->withInput();
        }
    }

    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function view()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return view('unsecured.pages.login');
    }
}
