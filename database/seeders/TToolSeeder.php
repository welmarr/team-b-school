<?php

namespace Database\Seeders;

use App\Models\TTool;
use App\Models\TUnit;
use App\Models\TToolType;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $toolTypes = [
            ['name' => 'Slide Hammers', 'description' => 'Hammers for pulling dents using impact'],
            ['name' => 'PDR Tools', 'description' => 'Tools specifically for Paintless Dent Repair'],
            ['name' => 'Dent Removal Rods', 'description' => 'Various rods and hooks for dent removal'],
            ['name' => 'Glue Systems', 'description' => 'Glue guns and related accessories for dent repair'],
            ['name' => 'Knockdown Tools', 'description' => 'Tools for knocking down high spots'],
            ['name' => 'Light Systems', 'description' => 'Light boards and reflectors to highlight dents'],
            ['name' => 'Mini Lifters', 'description' => 'Small lifters for precision dent repair'],
            ['name' => 'Heat Guns', 'description' => 'Guns used to apply heat during the dent repair process'],
            ['name' => 'Pliers', 'description' => 'Specialized pliers for dent repair'],
            ['name' => 'Body Hammers', 'description' => 'Hammers used for shaping and smoothing metal'],
        ];

        foreach ($toolTypes as $type) {
            TToolType::firstOrCreate(['name' => $type['name']], ['description' => $type['description']]);
        }

        $units = [
            ['name' => 'Each', 'description' => 'Represents a single unit or entity, typically used for items that are counted individually.', 'abbreviation' => 'EA'],
            ['name' => 'Set', 'description' => 'A collection of items', 'abbreviation' => 'SET'],
            ['name' => 'Kit', 'description' => 'A set of tools or equipment', 'abbreviation' => 'KIT'],
        ];

        foreach ($units as $unit) {
            TUnit::firstOrCreate(['name' => $unit['name']], ['description' => $unit['description'], 'abbreviation' => $unit['abbreviation']]);
        }

        $tools = [
            ['name' => 'Slide Hammer', 'description' => 'Used to pull out dents from panels', 'condition' => 8, 'tool_type' => 'Slide Hammers', 'unit' => 'Each'],
            ['name' => 'Dent Lifter', 'description' => 'Used to lift and repair dents', 'condition' => 9, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Dent Repair Rods', 'description' => 'Various rods for pushing out dents from the inside', 'condition' => 7, 'tool_type' => 'Dent Removal Rods', 'unit' => 'Set'],
            ['name' => 'Glue Pulling Kit', 'description' => 'Includes glue tabs and glue guns for pulling dents', 'condition' => 9, 'tool_type' => 'Glue Systems', 'unit' => 'Kit'],
            ['name' => 'Knockdown Tools', 'description' => 'Used to knock down high spots on the dented surface', 'condition' => 8, 'tool_type' => 'Knockdown Tools', 'unit' => 'Each'],
            ['name' => 'Light Reflector Board', 'description' => 'Reflects light to help identify dent positions', 'condition' => 10, 'tool_type' => 'Light Systems', 'unit' => 'Each'],
            ['name' => 'Mini Lifter', 'description' => 'Small tool for precise dent lifting', 'condition' => 9, 'tool_type' => 'Mini Lifters', 'unit' => 'Each'],
            ['name' => 'Heat Gun', 'description' => 'Used to apply heat to the dented area to aid in repair', 'condition' => 7, 'tool_type' => 'Heat Guns', 'unit' => 'Each'],
            ['name' => 'Dent Repair Pliers', 'description' => 'Special pliers for gripping and manipulating metal', 'condition' => 8, 'tool_type' => 'Pliers', 'unit' => 'Each'],
            ['name' => 'Rubber Hammer', 'description' => 'Used to gently tap out dents without damaging paint', 'condition' => 8, 'tool_type' => 'Body Hammers', 'unit' => 'Each'],
            ['name' => 'Suction Cup', 'description' => 'Used for pulling out larger dents', 'condition' => 9, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'T-bar Puller', 'description' => 'Tool for pulling dents using T-bar', 'condition' => 8, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Slide Hammer Adapter', 'description' => 'Adapter for slide hammer', 'condition' => 7, 'tool_type' => 'Slide Hammers', 'unit' => 'Each'],
            ['name' => 'Plastic Tabs', 'description' => 'Tabs for glue pulling', 'condition' => 9, 'tool_type' => 'Glue Systems', 'unit' => 'Set'],
            ['name' => 'Metal Tabs', 'description' => 'Metal tabs for glue pulling', 'condition' => 8, 'tool_type' => 'Glue Systems', 'unit' => 'Set'],
            ['name' => 'Dent Hammer', 'description' => 'Hammer for knocking down dents', 'condition' => 9, 'tool_type' => 'Knockdown Tools', 'unit' => 'Each'],
            ['name' => 'Line Board', 'description' => 'Board to reflect light for dent identification', 'condition' => 10, 'tool_type' => 'Light Systems', 'unit' => 'Each'],
            ['name' => 'Tap Down Tool', 'description' => 'Tool for tapping down high spots', 'condition' => 8, 'tool_type' => 'Knockdown Tools', 'unit' => 'Each'],
            ['name' => 'Dent Lifting Bracket', 'description' => 'Bracket for lifting dents', 'condition' => 9, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Hot Glue Gun', 'description' => 'Gun for applying hot glue', 'condition' => 7, 'tool_type' => 'Glue Systems', 'unit' => 'Each'],
            ['name' => 'Dent Removal Sticks', 'description' => 'Sticks for pushing out dents', 'condition' => 8, 'tool_type' => 'Dent Removal Rods', 'unit' => 'Set'],
            ['name' => 'Reflector Light', 'description' => 'Light for highlighting dents', 'condition' => 9, 'tool_type' => 'Light Systems', 'unit' => 'Each'],
            ['name' => 'Door Edge Protector', 'description' => 'Protector for door edges during repair', 'condition' => 10, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Hail Repair Rods', 'description' => 'Rods for repairing hail damage', 'condition' => 8, 'tool_type' => 'Dent Removal Rods', 'unit' => 'Set'],
            ['name' => 'Air Wedge', 'description' => 'Inflatable wedge for creating space', 'condition' => 9, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Edge Jack', 'description' => 'Tool for lifting dents near edges', 'condition' => 8, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Glue Sticks', 'description' => 'Sticks for glue gun', 'condition' => 10, 'tool_type' => 'Glue Systems', 'unit' => 'Pack'],
            ['name' => 'Dent Puller Kit', 'description' => 'Complete kit for pulling dents', 'condition' => 9, 'tool_type' => 'PDR Tools', 'unit' => 'Kit'],
            ['name' => 'Heavy Duty Suction Cup', 'description' => 'Strong suction cup for large dents', 'condition' => 8, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'PDR Training Kit', 'description' => 'Kit for training in paintless dent repair', 'condition' => 10, 'tool_type' => 'PDR Tools', 'unit' => 'Kit'],
            ['name' => 'Flexible Light', 'description' => 'Flexible light for detailed inspection', 'condition' => 9, 'tool_type' => 'Light Systems', 'unit' => 'Each'],
            ['name' => 'Bumper Repair Tool', 'description' => 'Tool for repairing bumper dents', 'condition' => 8, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Ratchet Straps', 'description' => 'Straps for securing items during repair', 'condition' => 9, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Panel Lifter', 'description' => 'Tool for lifting panels during repair', 'condition' => 10, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Trim Removal Tools', 'description' => 'Tools for removing trim without damage', 'condition' => 9, 'tool_type' => 'PDR Tools', 'unit' => 'Set'],
            ['name' => 'Sanding Block', 'description' => 'Block for sanding repaired areas', 'condition' => 8, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Buffer', 'description' => 'Machine for buffing repaired surfaces', 'condition' => 9, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Polishing Pad', 'description' => 'Pad for polishing repaired areas', 'condition' => 10, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Paint Touch-Up Kit', 'description' => 'Kit for touching up paint after repair', 'condition' => 8, 'tool_type' => 'PDR Tools', 'unit' => 'Kit'],
            ['name' => 'Welding Clamp', 'description' => 'Clamp for holding parts during welding', 'condition' => 9, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
            ['name' => 'Body Filler', 'description' => 'Material for filling dents before painting', 'condition' => 10, 'tool_type' => 'PDR Tools', 'unit' => 'Each'],
        ];

        foreach ($tools as $tool) {
            $toolType = TToolType::where('name', $tool['tool_type'])->first();
            $unit = TUnit::where('name', $tool['unit'])->first();

            if ($toolType && $unit) {
                TTool::create([
                    'name' => $tool['name'],
                    'description' => $tool['description'],
                    'track_usage' => rand(0,1),
                    'condition' => $tool['condition'],
                    'tool_type_id' => $toolType->id,
                    'unit_id' => $unit->id,
                ]);
            }
        }
    }
}
