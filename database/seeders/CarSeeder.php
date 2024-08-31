<?php

namespace Database\Seeders;

use App\Models\TCar;
use App\Models\TCarBrand;
use App\Models\TCarModel;
use League\Csv\Reader;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Log;

class CarSeeder extends Seeder
{
    //https://github.com/abhionlyone/us-car-models-data/tree/master
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Step 1: Define the CSV folder path
        $csvFolder = database_path('csv');

        // Step 2: Get all CSV files in the folder
        $csvFiles = File::files($csvFolder);

        // Step 3: Iterate through each CSV file and seed data
        foreach ($csvFiles as $file) {
            $this->seedFromCsv($file);
        }
    }

    /**
     * Seed data from a single CSV file.
     *
     * @param \SplFileInfo $file
     * @return void
     */
    protected function seedFromCsv($file)
    {
        // Step 1: Create CSV reader
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0); // Set the CSV header offset

        // Step 2: Get records from CSV
        $records = $csv->getRecords();

        // Step 3: Iterate through each record
        foreach ($records as $record) {
            // Step 3.1: Log the creation process
            error_log("Creation of ===> ". $record['model'] . " " . $record['make'] . " " . $record['year']);

            // Step 3.2: Get or create the make
            $make = TCarBrand::firstOrCreate(['name' => $record['make']]);

            // Step 3.3: Get or create the model
            $model = TCarModel::firstOrCreate(['name' => $record['model']]);

            // Step 3.4: Create the car entry
            TCar::create([
                'year' => $record['year'],
                'make_id' => $make->id,
                'model_id' => $model->id,
                'body_style' => $record['body_styles'],
            ]);
        }
    }
}
