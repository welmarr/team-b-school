<?php

namespace App\Http\Controllers\Secured\Dealer;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Secured\UpdateUserProfileRequest;

class ProfileController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function index()
    {
        $activeMenu = 'profile';
        $user = Auth::user();
        
        // Retrieve dealer and address information
        $dealer = $user->TDealership; // Assuming this relationship is defined
        $address = $dealer ? $dealer->TAddress : null; // Retrieve address if dealership exists

        return view('secured.pages.dealer.profile', compact(['user', 'activeMenu', 'dealer', 'address']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserProfileRequest $request)
    {
        // Retrieve the authenticated user
        $user = Auth::user();

        // Update user personal information
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        
        // Save user changes
        $user->save();

        // Update dealership information if it exists
        if ($user->TDealership) {
            $dealership = $user->TDealership;
            $dealership->name = $request->input('dealer_name');
            $dealership->phone = $request->input('dealer_phone_number');

            // Save dealership changes
            $dealership->save();

            // Update address information if it exists
            if ($dealership->TAddress) {
                $address = $dealership->TAddress;
                $address->address_line_1 = $request->input('address');
                $address->address_line_2 = $request->input('address2');
                $address->city = $request->input('city');
                $address->state = $request->input('state');
                $address->zip = $request->input('zip');

                // Save address changes
                $address->save();
            } else {
                // If address does not exist, create a new one
                $dealership->TAddress()->create([
                    'address_line_1' => $request->input('address'),
                    'address_line_2' => $request->input('address2'),
                    'city' => $request->input('city'),
                    'state' => $request->input('state'),
                    'zip' => $request->input('zip'),
                ]);
            }
        }

        // Redirect back to the profile page with a success message
        return redirect()->route('secured.dealer.profile')->with('success', 'Profile updated successfully.');
    }


}
