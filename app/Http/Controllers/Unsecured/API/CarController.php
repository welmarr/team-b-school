<?php

namespace App\Http\Controllers\Unsecured\Api;

use App\Http\Controllers\Controller;
use App\Models\TCarModel;

class CarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($brand, $year)
    {
        $carModels = TCarModel::whereHas('cars', function ($query) use ($year, $brand) {
            $query->where('year', $year)->where('make_id', $brand);
        })->select('id', 'name')->get();

        return response()->json(['models' => $carModels]);
    }
}
