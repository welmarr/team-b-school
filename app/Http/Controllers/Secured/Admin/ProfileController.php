<?php

namespace App\Http\Controllers\Secured\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Secured\UpdateUserProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display the profile page.
     */
    public function index()
    {
        $activeMenu = 'profile';
        $user = Auth::user();
        return view('secured.pages.admin.profile', compact('user', 'activeMenu'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(UpdateUserProfileRequest $request)
{
    $validated = $request->validated();
    $user = Auth::user();  // Get the authenticated user

    try {
        // Update the user's profile
        $user->update([
            'first_name' => trim($validated['first_name']),
            'last_name' => trim($validated['last_name']),
            'email' => trim($validated['email']),
            'phone' => trim($validated['phone']),
        ]);

        return redirect()->back()->with('success', 'Profile has been updated successfully.');
    } catch (\Exception $e) {
        return redirect()->back()->withInput()->withErrors('There was an error processing your request: ' . $e->getMessage());
    }
}

}
