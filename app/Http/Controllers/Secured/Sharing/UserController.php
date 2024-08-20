<?php

namespace App\Http\Controllers\Secured\Sharing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Secured\InitialSetupRequest;

class UserController extends Controller
{
    /**
     * Display the initial setup view.
     *
     * @return \Illuminate\View\View
     */
    public function initialSetupView()
    { 
        return view('secured.pages.sharing.users.initial-setup');
    }

    /**
     * Handle the initial setup process for a user.
     *
     * @param  \App\Http\Requests\Secured\InitialSetupRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function initialSetupCreate(InitialSetupRequest $request)
    {
        try {
            $validated = $request->validated();

            $user = Auth::user();
            $user->update([
                'password' => bcrypt($validated['password']),
                'first_connect_at' => \Carbon\Carbon::now(),
            ]);

            $redirectRoute = $user->role === 'admin' ? 'secured.admin.dashboard' : 'secured.dealers.dashboard';

            $request->session()->regenerate();

            return redirect()->route($redirectRoute);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An unexpected error occurred. Please try again. [' . $e->getMessage() . ']')->withInput();
        }
    }
}
