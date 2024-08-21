<?php

namespace App\Http\Controllers\Secured\Sharing;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Secured\UpdateUserProfileRequest;
use App\Models\TDealership;

class ProfileController extends Controller
{
    /**
     * Display the profile page.
     */
    public function view()
    {
        $activeMenu = 'profile';
        $user = Auth::user();
        //$dealership =  TDealership::where('id', $user->dealership_id)->first();

        //dd($user->dealership, $dealership, Auth::user()->email);
        return view('secured.pages.sharing.users.profile', compact('user', 'activeMenu'));
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
                'phone' => trim($validated['phone']),
            ]);

            return redirect()->back()->with('success', 'Profile has been updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'There was an error processing your request: ' . $e->getMessage());
        }
    }
}
