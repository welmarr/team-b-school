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
        $csvFolder = database_path('csv');

        // Get all CSV files in the folder
        $csvFiles = File::files($csvFolder);

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
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0); // Set the CSV header offset

        $records = $csv->getRecords();

        foreach ($records as $record) {
            error_log("Creation of ===> ". $record['model'] . " " . $record['make'] . " " . $record['year']);

            // Get or create the make
            $make = TCarBrand::firstOrCreate(['name' => $record['make']]);

            // Get or create the model
            $model = TCarModel::firstOrCreate(['name' => $record['model']]);

            // Create the car entry
            TCar::create([
                'year' => $record['year'],
                'make_id' => $make->id,
                'model_id' => $model->id,
                'body_style' => $record['body_styles'],
            ]);
        }
    }
}
