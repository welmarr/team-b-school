<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TDealership;
use App\Models\User;

class DealershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Step 1: Create 5 dealerships
        TDealership::factory()->count(5)->create();

        // Step 2: Retrieve dealerships without a 'dealer-admin' user
        $dealershipsWithoutDealerAdmin = TDealership::whereDoesntHave('users', function ($query) {
            $query->where('role', 'dealer-admin');
        })->get();

        // Step 3: Assign 'dealer-admin' users (with dealership_id null) to dealerships without a 'dealer-admin'
        $dealerAdminUsers = User::where('role', 'dealer-admin')->whereNull('dealership_id')->get();

        foreach ($dealerAdminUsers as $dealerAdminUser) {
            if ($dealershipsWithoutDealerAdmin->isEmpty()) {
                break; // Stop if there are no more dealerships without 'dealer-admin'
            }

            // Assign the first available dealership without 'dealer-admin' to the 'dealer-admin' user
            $dealership = $dealershipsWithoutDealerAdmin->shift(); // Get and remove the first dealership from the collection
            $dealerAdminUser->update(['dealership_id' => $dealership->id]);
        }

        // Step 4: Assign all 'dealer' users (with dealership_id null) to dealerships randomly
        $dealerUsers = User::where('role', 'dealer')->whereNull('dealership_id')->get();

        // Ensure that the list of dealerships is up to date and shuffled
        $availableDealerships = TDealership::all(); // Get all dealerships

        foreach ($dealerUsers as $user) {
            if ($availableDealerships->isEmpty()) {
                break; // Stop if there are no available dealerships
            }

            // Assign a random dealership to the 'dealer' user
            $randomDealership = $availableDealerships->random(); // Get a random dealership
            $user->update(['dealership_id' => $randomDealership->id]);
        }
    }
}
