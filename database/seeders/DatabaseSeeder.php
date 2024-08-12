<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            /*DealershipSeeder::class,
            UserSeeder::class,
            CarSeeder::class,*/
            UnitSeeder::class,
            TToolTypeSeeder::class,
            TToolSeeder::class,
        ]);
    }
}
