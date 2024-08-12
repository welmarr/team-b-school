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
     */
    public function core(LoginRequest $request)
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
                $error = 'Your email address is not verified.';
            } elseif (!$user->is_active) {
                Auth::logout();
                $error = 'Your account is inactive.';
            } else {
                // If the user is an Admin, check and update first_connect_at
                if ($user->role === 'admin' && is_null($user->first_connect_at)) {
                    $user->update(['first_connect_at' => Carbon::now()]);
                }

                //dd( $user->role);
                // Redirect based on role
                $redirectRoute = $user->role === 'admin' ? 'secured.admin.dashboard' : 'unsecured.not-found';

                // Regenerate session and redirect
                $request->session()->regenerate();
            }



            // If there was an error, redirect back with the error message
            return $error != null ? redirect()->back()->with('error', $error)->withInput() : redirect()->route($redirectRoute);
        } catch (ValidationException $e) {
            // Redirect back to the login form with validation errors
            return redirect()->back()->withErrors($e->errors())->withInput();
        } catch (\Exception $e) {
            // Handle any other exceptions that may occur
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again. [' .  $e->getMessage() . "]")->withInput();
        }
    }
}
