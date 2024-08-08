<?php

namespace App\Http\Controllers\Unsecured\Api;

use App\Http\Controllers\Controller;
use App\Models\TCarModel;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getModelByBrandAndYear($brand, $year)
    {
        $carModels = TCarModel::whereHas('cars', function ($query) use ($year, $brand) {
            $query->where('year', $year)->where('make_id', $brand);
        })->select('id', 'name')->get();

        return response()->json(['models' => $carModels]);
    }
}
