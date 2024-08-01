<?php

namespace App\Http\Controllers\Unsecured;

use App\Models\User;
use App\Models\Address;
use App\Models\Dealership;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\Unsecured\SignupRequest;

class SignUpController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param SignupRequest $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function core(SignupRequest $request)
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
                $dealership = $this->createNewDealership($user, $validated);

                // Create a new address for the dealership if it was created successfully
                if($dealership != null) {
                    $address = $this->createDealershipAddress($dealership, $validated);
                }
            }

            // Associate the user with the dealership if it exists
            if($dealership != null) {
                $user->dealership_id = $dealership->id;
                $user->save();
            }

            // Return the account created view
            return redirect()->route('unsecured.sign-up')->with('page_need', 'login-success');
        } catch (\Exception $e) {
            // Handle exceptions and delete any rows that were already created
            $this->deleteRowAlreadyCreated($e, $user, $dealership, $address, $validated);

            // Redirect back to the sign-up page with an error message
            return redirect()->route('unsecured.sign-up')->withErrors(['er-500' => 'There was an error processing your request. ' . $e->getMessage()]);
        }
    }

    /**
     * Create a new user.
     *
     * @param array $validated
     * @return User
     */
    private function createUser($validated)
    {
        // Create and return a new user
        return User::create([
            "email" => $validated["email"],
            "password" => bcrypt($validated["password"]),
            "first_name" => $validated["first_name"],
            "last_name" => $validated["last_name"],
            "phone" => $validated["phone"],
            "role" => "dealer",
        ]);
    }

    /**
     * Find an existing dealership.
     *
     * @param array $validated
     * @return Dealership
     */
    private function findExistingDealership($validated)
    {
        // Find and return an existing dealership by code
        return Dealership::where('code', $validated['dealership_code'])->first();
    }

    /**
     * Create a new dealership.
     *
     * @param User $user
     * @param array $validated
     * @return Dealership
     */
    private function createNewDealership($user, $validated)
    {
        // Generate a unique code for the new dealership
        $code = date('H') . date('i') . '-' . $this->generateRandomAlphanumericCode(rand(2, 4));

        // Create and return a new dealership
        return Dealership::create([
            "name" => $validated["new_dealership_name"],
            "phone" => $validated["new_dealership_phone"],
            "code" => $code,
            "admin_id" => $user->id
        ]);
    }

    /**
     * Create a new address for the dealership.
     *
     * @param Dealership $dealership
     * @param array $validated
     * @return Address|null
     */
    private function createDealershipAddress($dealership, $validated)
    {
        // Check if the new dealership address line 1 is provided
        if ($validated['new_dealership_address_line_1'] != null) {
            // Create and return a new address for the dealership
            return Address::create([
                "address_line_1" => $validated["new_dealership_address_line_1"],
                "address_line_2" => $validated["new_dealership_address_line_2"],
                "city" => $validated["new_dealership_city"],
                "state" => $validated["new_dealership_state"],
                "zip" => $validated["new_dealership_zip"],
                "dealership_id" => $dealership->id,
                "is_primary" => true,
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
     * @param Dealership|null $dealership
     * @param Address|null $address
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
                Address::where('dealership_id', $dealership->id)->forceDelete();
            }

            // Delete the dealership if it was created
            if ($dealership != null) {
                Dealership::where('id', $dealership->id)->forceDelete();
            }
        }

        // Delete the user if it was created
        if ($user != null) {
            User::where('id', $user->id)->forceDelete();
        }
    }

    /**
     * Generate a random alphanumeric code of a given length.
     *
     * @param int $length
     * @return string
     */
    protected function generateRandomAlphanumericCode($length)
    {
        // Define the characters to use for the random code
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $charactersLength = strlen($characters);
        $randomString = '';

        // Generate the random code
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        // Return the generated code
        return $randomString;
    }
}
