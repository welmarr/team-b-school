<?php

namespace App\Http\Controllers\Secured\Admin\Api;

use App\Models\TUnit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Secured\StoreUnitRequest;
use App\Http\Requests\Secured\UpdateUnitRequest;
use Yajra\DataTables\Facades\DataTables;

/**
 * Class UnitController
 * @package App\Http\Controllers\Secured\Admin\Api
 */
class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        return DataTables::eloquent(TUnit::select())
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\Secured\StoreUnitRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreUnitRequest $request)
    {
        $validated = $request->validated();
        try {
            // Create and return a new unit
            $unit = TUnit::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'abbreviation' => $validated['abbreviation'],
            ]);

            return response()->json(['data' => $unit, 'msg' => "Unit " . $validated['name'].' created.'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => null, 'msg' => 'There was an error processing your request. '.$e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Secured\UpdateUnitRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateUnitRequest $request, int $id)
    {
        $validated = $request->validated();
        try {
            $unit = TUnit::findOrFail($id);
            // Update the existing unit
            $unit->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
                'abbreviation' => $validated['abbreviation'],
            ]);

            return response()->json(['data' => $unit, 'msg' => "Unit " . $validated['name'].' updated.'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => null, 'msg' => 'There was an error processing your request. '.$e->getMessage()], 500);
        }
    }

}
