<?php

namespace App\Http\Controllers\Secured\Admin;


use App\Http\Controllers\Controller;
use App\Models\TTool;
use App\Http\Requests\Secured\StoreToolRequest;
use App\Http\Requests\Secured\UpdateToolRequest;

class ToolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('secured.pages.admin.tools',  ['activeMenu' => 'tools']);
    }

    /**
     * Display a listing of the resource.
     */
    public function indexDataTableApi(Request $request)
    {
        return DataTables::eloquent(TTools::select())
        ->toJson();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreToolRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Tool $tool)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tool $tool)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateToolRequest $request, Tool $tool)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tool $tool)
    {
        //
    }
}
