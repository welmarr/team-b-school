<?php

namespace Database\Seeders;

use App\Models\TTool;
use App\Models\TRequest;
use Illuminate\Database\Seeder;
use App\Models\TToolInventoryMovement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TToolInventoryMovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

     public function run()
     {
         // Get all existing TTools and TRequests
         $tools = TTool::all();
         $requests = TRequest::all();

         // Check if there are any tools and requests available
         if ($tools->isEmpty()) {
             $this->command->info('No TTools found. Please seed the TTools table first.');
             return;
         }

         if ($requests->isEmpty()) {
             $this->command->info('No TRequests found. Please seed the TRequests table first.');
             return;
         }

         // 1. Add stock to half of the tools
         $stockAdded = [];
         $toolsToStock = $tools->random($tools->count() / 2);
         foreach ($toolsToStock as $tool) {
            $stock = rand(50, 100);
             TToolInventoryMovement::create([
                 'quantity' => $stock, // Random quantity
                 'note' => 'Stock added',
                 'type' => 'Added',
                 'tool_id' => $tool->id,
                 'request_id' => null, // Null because type is 'Added'
             ]);
             $stockAdded[$tool->id] = $stock;
         }

         // 2. Add tool movements for all existing requests (1 to 4 movements per request)
         foreach ($requests as $request) {
             $movementCount = rand(1, count($stockAdded));

             for ($i = 0; $i < $movementCount; $i++) {
                 $tool_id = array_keys($stockAdded)[rand(0, count($stockAdded) - 1)]; // Pick a random tool
                 $stock = -1 * rand(1, $stockAdded[$tool_id]);

                 TToolInventoryMovement::create([
                     'quantity' => $stock, // Random quantity
                     'note' => 'Used in request',
                     'type' => 'Used',
                     'tool_id' => $tool_id,
                     'request_id' => $request->id, // Assign to the current request
                 ]);
             }
         }

         // 3. Scrap some tools (random selection)
         $toolsToScrap = $tools->random(rand(1, $tools->count() / 4)); // Scrap up to a quarter of the tools

         foreach ($toolsToScrap as $tool) {
             TToolInventoryMovement::create([
                 'quantity' => rand(1, 5), // Random quantity to scrap
                 'note' => 'Tool scrapped',
                 'type' => 'Scraped',
                 'tool_id' => $tool->id,
                 'request_id' => null, // Null because type is 'Scraped'
             ]);
         }
     }
}
