<?php

namespace Database\Seeders;

use App\Models\TUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $units = [
            ['name' => 'Each', 'description' => 'Represents a single unit or entity, typically used for items that are counted individually.', 'abbreviation' => 'EA'],
            ['name' => 'Kilogram', 'description' => 'Unit of mass', 'abbreviation' => 'kg'],
            ['name' => 'Meter', 'description' => 'Unit of length', 'abbreviation' => 'm'],
            ['name' => 'Second', 'description' => 'Unit of time', 'abbreviation' => 's'],
            ['name' => 'Ampere', 'description' => 'Unit of electric current', 'abbreviation' => 'A'],
            ['name' => 'Kelvin', 'description' => 'Unit of thermodynamic temperature', 'abbreviation' => 'K'],
            ['name' => 'Mole', 'description' => 'Unit of substance amount', 'abbreviation' => 'mol'],
            ['name' => 'Candela', 'description' => 'Unit of luminous intensity', 'abbreviation' => 'cd'],
            ['name' => 'Gram', 'description' => 'Unit of mass', 'abbreviation' => 'g'],
            ['name' => 'Centimeter', 'description' => 'Unit of length', 'abbreviation' => 'cm'],
            ['name' => 'Millisecond', 'description' => 'Unit of time', 'abbreviation' => 'ms'],
            ['name' => 'Liter', 'description' => 'Unit of volume', 'abbreviation' => 'L'],
            ['name' => 'Newton', 'description' => 'Unit of force', 'abbreviation' => 'N'],
            ['name' => 'Joule', 'description' => 'Unit of energy', 'abbreviation' => 'J'],
            ['name' => 'Watt', 'description' => 'Unit of power', 'abbreviation' => 'W'],
            ['name' => 'Pascal', 'description' => 'Unit of pressure', 'abbreviation' => 'Pa'],
            ['name' => 'Hertz', 'description' => 'Unit of frequency', 'abbreviation' => 'Hz'],
            ['name' => 'Degree Celsius', 'description' => 'Unit of temperature', 'abbreviation' => '°C'],
            ['name' => 'Minute', 'description' => 'Unit of time', 'abbreviation' => 'min'],
            ['name' => 'Hour', 'description' => 'Unit of time', 'abbreviation' => 'h'],
            ['name' => 'Day', 'description' => 'Unit of time', 'abbreviation' => 'd'],
            ['name' => 'Year', 'description' => 'Unit of time', 'abbreviation' => 'yr'],
            ['name' => 'Byte', 'description' => 'Unit of digital information', 'abbreviation' => 'B'],
            ['name' => 'Kilobyte', 'description' => 'Unit of digital information', 'abbreviation' => 'KB'],
            ['name' => 'Megabyte', 'description' => 'Unit of digital information', 'abbreviation' => 'MB'],
            ['name' => 'Gigabyte', 'description' => 'Unit of digital information', 'abbreviation' => 'GB'],
            ['name' => 'Terabyte', 'description' => 'Unit of digital information', 'abbreviation' => 'TB'],
            ['name' => 'Bit', 'description' => 'Unit of digital information', 'abbreviation' => 'bit'],
            ['name' => 'Kilobit', 'description' => 'Unit of digital information', 'abbreviation' => 'Kbit'],
            ['name' => 'Megabit', 'description' => 'Unit of digital information', 'abbreviation' => 'Mbit'],
            ['name' => 'Gigabit', 'description' => 'Unit of digital information', 'abbreviation' => 'Gbit'],
            ['name' => 'Terabit', 'description' => 'Unit of digital information', 'abbreviation' => 'Tbit'],
            ['name' => 'Calorie', 'description' => 'Unit of energy', 'abbreviation' => 'cal'],
            ['name' => 'Kilocalorie', 'description' => 'Unit of energy', 'abbreviation' => 'kcal'],
            ['name' => 'Bar', 'description' => 'Unit of pressure', 'abbreviation' => 'bar'],
            ['name' => 'Millibar', 'description' => 'Unit of pressure', 'abbreviation' => 'mbar'],
            ['name' => 'Atmosphere', 'description' => 'Unit of pressure', 'abbreviation' => 'atm'],
            ['name' => 'Inch', 'description' => 'Unit of length', 'abbreviation' => 'in'],
            ['name' => 'Foot', 'description' => 'Unit of length', 'abbreviation' => 'ft'],
            ['name' => 'Yard', 'description' => 'Unit of length', 'abbreviation' => 'yd'],
            ['name' => 'Mile', 'description' => 'Unit of length', 'abbreviation' => 'mi'],
            ['name' => 'Ounce', 'description' => 'Unit of mass', 'abbreviation' => 'oz'],
            ['name' => 'Pound', 'description' => 'Unit of mass', 'abbreviation' => 'lb'],
            ['name' => 'Stone', 'description' => 'Unit of mass', 'abbreviation' => 'st'],
            ['name' => 'Gallon', 'description' => 'Unit of volume', 'abbreviation' => 'gal'],
            ['name' => 'Quart', 'description' => 'Unit of volume', 'abbreviation' => 'qt'],
            ['name' => 'Pint', 'description' => 'Unit of volume', 'abbreviation' => 'pt'],
            ['name' => 'Cup', 'description' => 'Unit of volume', 'abbreviation' => 'cup'],
            ['name' => 'Teaspoon', 'description' => 'Unit of volume', 'abbreviation' => 'tsp'],
            ['name' => 'Tablespoon', 'description' => 'Unit of volume', 'abbreviation' => 'tbsp'],
            ['name' => 'Volt', 'description' => 'Unit of electric potential', 'abbreviation' => 'V'],
            ['name' => 'Ohm', 'description' => 'Unit of electrical resistance', 'abbreviation' => 'Ω'],
            ['name' => 'Siemens', 'description' => 'Unit of electrical conductance', 'abbreviation' => 'S'],
        ];

        foreach ($units as $unit) {
            TUnit::create($unit);
        }
    }
}
