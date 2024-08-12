<?php

namespace App\Http\Controllers\Secured\Admin\Api;

use App\Models\TToolType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Secured\StoreToolTypeRequest;
use App\Http\Requests\Secured\UpdateToolTypeRequest;

class ToolTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return DataTables::eloquent(TToolType::select())
            ->toJson();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreToolTypeRequest $request)
    {

        $validated = $request->validated();
        try {
            // Create and return a new user
            $type = TToolType::create([
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);

            return response()->json(['data' => $type, 'msg' => "Tool type" . $validated['name'].' created.'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => null, 'msg' => 'There was an error processing your request. '.$e->getMessage()], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateToolTypeRequest $request, int $id)
    {

        $validated = $request->validated();
        try {
            $tToolType = TToolType::findOrFail($id);
            //dd($tToolType->name);
            // Create and return a new user
            $tToolType->update([
                'name' => $validated['name'],
                'description' => $validated['description'],
            ]);

            return response()->json(['data' => $tToolType, 'msg' => "Tool type" . $validated['name'].' updated.'], 200);
        } catch (\Exception $e) {
            return response()->json(['data' => null, 'msg' => 'There was an error processing your request. '.$e->getMessage()], 500);
        }
    }
}
