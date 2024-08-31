<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Create 10 users with verified email
        User::factory()->count(10)->create();

        // Create 5 users with unverified email
        User::factory()->unverified()->count(10)->create();

        // Create 5 users admin dealer
        User::factory()->dealerAdmin()->count(5)->create();
    }
}
