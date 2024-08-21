<?php

namespace App\Http\Controllers\Secured\Sharing;

use App\Models\TAddress;
use App\Models\TDealership;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Secured\UpdateUserProfileRequest;
use App\Http\Requests\Secured\UpdateDealershipProfileRequest;

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


    public function updateDealerShip(UpdateDealershipProfileRequest $request)
    {
        $validated = $request->validated();
        try {
            $dealership = TDealership::where('id', Auth::user()->dealership_id)->first();
            // Update the user's profile
            $dealership->update([
                'name' => trim($validated['dealership_name']),
                'phone' => trim($validated['dealership_phone']),
            ]);

            if (isset($validated['dealership_address_line_1']) && $dealership->address_id != null) {
                TAddress::where('id', $dealership->address_id)->update([
                    "address_line_1" => $validated["dealership_address_line_1"],
                    "address_line_2" => $validated["dealership_address_line_2"],
                    "city" => $validated["dealership_city"],
                    "state" => $validated["dealership_state"],
                    "zip" => $validated["dealership_zip"],
                ]);
            }

            return redirect()->back()->with('dealership_success', 'Dealership profile has been updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('dealership_error', 'There was an error processing your request: ' . $e->getMessage());
        }
    }
}
