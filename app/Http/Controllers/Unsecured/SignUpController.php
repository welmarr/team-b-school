<?php

namespace App\Http\Controllers\Unsecured;

use App\Models\User;
use App\Models\TAddress;
use App\Models\TDealership;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\AccountCreationBySimpleUserMail;
use App\Http\Requests\Unsecured\SignupRequest;

class SignUpController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param SignupRequest $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function submit(SignupRequest $request)
    {
        // Initialize variables
        $user = null;
        $dealership = null;
        $address = null;
        $validated = $request->validated();

        try {
            // Create a new user
            $user = $this->createUser($validated);

            // Check dealership option and handle accordingly
            if ($validated['dealership_option'] === 'use_dealership') {
                // Find an existing dealership
                $dealership = $this->findExistingDealership($validated);
            } elseif ($validated['dealership_option'] === 'create_dealership') {
                // Create a new dealership
                $dealership = $this->createNewDealership($validated);

                // Create a new address for the dealership if it was created successfully
                if ($dealership != null) {
                    $address = $this->createDealershipAddress($validated);
                }
            }

            // Associate the user with the dealership if it exists
            if ($dealership != null) {
                $user->dealership_id = $dealership->id;
                if ($address) {
                    $dealership->address_id = $address->id;
                    $dealership->save();
                }
                $user->save();
            }

            Mail::to($user->email)->queue(new AccountCreationBySimpleUserMail($user));

            // Return the account created view
            return redirect()->route('account-created');
        } catch (\Exception $e) {
            // Handle exceptions and delete any rows that were already created
            $this->deleteRowAlreadyCreated($e, $user, $dealership, $address, $validated);

            // Redirect back to the sign-up page with an error message
            return redirect()->route('sign-up')->with('error', 'There was an error processing your request. ' . $e->getMessage());
        }
    }



    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function view()
    {
        return view('unsecured.pages.sign-up');
    }

    /**
     * Create a new user.
     *
     * @param array $validated
     * @return User
     */
    private function createUser($validated)
    {
        $user_role = "";
        if ($validated['dealership_option'] === 'use_dealership') {
            $user_role = "dealer";
        } elseif ($validated['dealership_option'] === 'create_dealership') {
            $user_role = "dealer-admin";
        } else {
            $user_role = "simple-customer";
        }

        // Create and return a new user
        return User::create([
            "email" => $validated["email"],
            "password" => bcrypt($validated["password"]),
            "first_name" => $validated["first_name"],
            "last_name" => $validated["last_name"],
            "phone" => $validated["phone"],
            "role" => $user_role,
        ]);
    }

    /**
     * Find an existing dealership.
     *
     * @param array $validated
     * @return TDealership
     */
    private function findExistingDealership($validated)
    {
        // Find and return an existing dealership by code
        return TDealership::where('code', $validated['dealership_code'])->first();
    }

    /**
     * Create a new dealership.
     *
     * @param User $user
     * @param array $validated
     * @return TDealership
     */
    private function createNewDealership($validated)
    {

        // Create and return a new dealership
        return TDealership::create([
            "name" => $validated["new_dealership_name"],
            "phone" => $validated["new_dealership_phone"],
            "code" =>  generateRandomAlphanumericCode(rand(3, 5)),
        ]);
    }

    /**
     * Create a new address for the dealership.
     *
     * @param TDealership $dealership
     * @param array $validated
     * @return TAddress|null
     */
    private function createDealershipAddress($validated)
    {
        // Check if the new dealership address line 1 is provided
        if ($validated['new_dealership_address_line_1'] != null) {
            // Create and return a new address for the dealership
            return TAddress::create([
                "address_line_1" => $validated["new_dealership_address_line_1"],
                "address_line_2" => $validated["new_dealership_address_line_2"],
                "city" => $validated["new_dealership_city"],
                "state" => $validated["new_dealership_state"],
                "zip" => $validated["new_dealership_zip"],
            ]);
        }

        // Return null if no address line 1 is provided
        return null;
    }

    /**
     * Handle exceptions that occur during the user creation process.
     *
     * @param \Exception $e
     * @param User|null $user
     * @param TDealership|null $dealership
     * @param TAddress|null $address
     * @param array $validated
     */
    private function deleteRowAlreadyCreated($e, $user, $dealership, $address, $validated)
    {
        // Log the error message
        Log::error('Error creating user: ' . $e->getMessage());

        // Check if the dealership option was to create a new dealership
        if ($validated['dealership_option'] === 'create_dealership') {
            // Delete the address if it was created
            if ($validated['new_dealership_address_line_1'] != null && $address != null) {
                TAddress::where('dealership_id', $dealership->address_id)->forceDelete();
            }

            // Delete the dealership if it was created
            if ($dealership != null) {
                TDealership::where('id', $dealership->id)->forceDelete();
            }
        }

        // Delete the user if it was created
        if ($user != null) {
            User::where('id', $user->id)->forceDelete();
        }
    }
}
