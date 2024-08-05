<?php

namespace Database\Seeders;

use App\Models\TDealership;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DealershipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TDealership::factory()->count(5)->create();
    }
}
