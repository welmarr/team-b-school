<?php

namespace Database\Seeders;

use App\Models\TToolType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TToolTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toolTypes = [
            ['name' => 'PDR Tools', 'description' => 'Tools specifically for Paintless Dent Repair'],
            ['name' => 'Pulling Tabs', 'description' => 'Tabs used for glue pulling method in dent repair'],
            ['name' => 'Glue Systems', 'description' => 'Glue guns and related accessories for dent repair'],
            ['name' => 'Dent Removal Rods', 'description' => 'Various rods and hooks for dent removal'],
            ['name' => 'Slide Hammers', 'description' => 'Hammers for pulling dents using impact'],
            ['name' => 'Mini Lifters', 'description' => 'Small lifters for precision dent repair'],
            ['name' => 'Knockdown Tools', 'description' => 'Tools for knocking down high spots'],
            ['name' => 'Light Systems', 'description' => 'Light boards and reflectors to highlight dents'],
            ['name' => 'Heat Guns', 'description' => 'Guns used to apply heat during the dent repair process'],
            ['name' => 'Suction Cups', 'description' => 'Suction devices for pulling out dents'],
            ['name' => 'Dent Removal Kits', 'description' => 'Complete kits for dent removal'],
            ['name' => 'Body Hammers', 'description' => 'Hammers used for shaping and smoothing metal'],
            ['name' => 'Dollies', 'description' => 'Anvils used in conjunction with body hammers'],
            ['name' => 'Pry Bars', 'description' => 'Bars used to apply leverage in dent removal'],
            ['name' => 'Sanders', 'description' => 'Power tools for sanding the surface after repair'],
            ['name' => 'Buffers', 'description' => 'Machines used for polishing repaired areas'],
            ['name' => 'Polishing Pads', 'description' => 'Pads used for polishing'],
            ['name' => 'Wedges', 'description' => 'Tools used to create space between panels'],
            ['name' => 'Pliers', 'description' => 'Specialized pliers for dent repair'],
            ['name' => 'Body Filler', 'description' => 'Materials used to fill in dents before painting'],
            ['name' => 'Sanding Blocks', 'description' => 'Blocks used for hand sanding'],
            ['name' => 'Scrapers', 'description' => 'Tools used to remove old paint or filler'],
            ['name' => 'Paint Sprayers', 'description' => 'Equipment for applying paint after dent repair'],
            ['name' => 'Protective Gear', 'description' => 'Safety equipment for dent repair technicians'],
            ['name' => 'Tool Storage', 'description' => 'Storage solutions for organizing tools'],
            ['name' => 'Measuring Tools', 'description' => 'Tools for measuring dents and repair areas'],
            ['name' => 'Inspection Mirrors', 'description' => 'Mirrors used for inspecting hard-to-see areas'],
            ['name' => 'Panel Removal Tools', 'description' => 'Tools for removing and installing panels'],
            ['name' => 'Ratchets and Sockets', 'description' => 'Tools for tightening and loosening bolts'],
            ['name' => 'Wrenches', 'description' => 'Various wrenches used in dent repair'],
        ];

        foreach ($toolTypes as $toolType) {
            TToolType::create($toolType);
        }
    }
}
