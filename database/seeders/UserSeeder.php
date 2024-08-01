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
        User::factory()->count(50)->create();

        // Create 5 users with unverified email
        User::factory()->unverified()->count(20)->create();
    }
}
