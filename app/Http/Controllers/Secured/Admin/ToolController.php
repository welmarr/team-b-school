<?php

namespace App\Http\Controllers\Secured\Admin;


use Carbon\Carbon;
use App\Models\Tool;
use App\Models\TTool;
use App\Models\TUnit;
use App\Models\TToolType;
use App\Http\Controllers\Controller;
use App\Models\TToolInventoryMovement;
use App\Http\Requests\Secured\StoreToolRequest;
use App\Http\Requests\Secured\UpdateToolRequest;

class ToolController extends Controller
{


    /**
     * Show the form for editing the specified resource.
     */
    public function history(TTool $tool)
    {
        $addedMovements = TToolInventoryMovement::where('tool_id', $tool->id)->where('type', 'Added')->paginate(10);
        $scrapedMovements = TToolInventoryMovement::where('tool_id', $tool->id)->where('type', 'Scraped')->paginate(10);
        $usedMovements = TToolInventoryMovement::where('tool_id', $tool->id)->where('type', 'Used')->paginate(10);

        $activeMenu = 'tools';
        return view('secured.pages.admin.tools-history', compact(['activeMenu', 'tool', 'addedMovements', 'scrapedMovements', 'usedMovements']));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function fullHistory(TTool $tool)
    {
        $inventory = TToolInventoryMovement::paginate(10);
        $activeMenu = 'tools';
        return view('secured.pages.admin.tools-history', compact(['activeMenu', 'inventory', 'tool',]));
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activeMenu = 'tools';
        return view('secured.pages.admin.tools', compact(['activeMenu']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = TToolType::all();
        $units = TUnit::all();
        $activeMenu = 'tools';
        return view('secured.pages.admin.tools-create', compact(['activeMenu', 'units', 'types']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreToolRequest $request)
    {
        $validated = $request->validated();
        try {
            // Create and return a new unit
            $tool = TTool::create([
                'name' => trim($validated['name']),
                'description' => $validated['description'],
                'condition' => $validated['alert'],
                'tool_type_id' => $validated['type'],
                'unit_id' => $validated['unit'],
                'track_usage' => isset($validated['tracked']) ? true : false,
                'enable_tracking_at' => isset($validated['tracked'])  ? Carbon::now() : null,
            ]);
            $tool = TTool::find($tool->id);

            return redirect()->back()->with('success', "Tool " . $validated['name'] . ' created.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'There was an error processing your request. ' . $e->getMessage());
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TTool $tool)
    {
        $types = TToolType::all();
        $units = TUnit::all();
        $activeMenu = 'tools';
        return view('secured.pages.admin.tools-edit', compact(['activeMenu', 'units', 'types', 'tool']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateToolRequest $request, TTool $tool)
    {
        $validated = $request->validated();
        try {

            // Create and return a new unit
            $tool = $tool->update([
                'name' => trim($validated['name']),
                'description' => $validated['description'],
                'condition' => $validated['alert'],
                'tool_type_id' => $validated['type'],
                'unit_id' => $validated['unit'],
                'track_usage' => isset($validated['tracked']) ? true : false,
                'enable_tracking_at' => isset($validated['tracked'])  ? Carbon::now() : null,
            ]);

            return redirect()->back()->with('success', "Tool " . $validated['name'] . ' updated.');
        } catch (\Exception $e) {
            return redirect()->back()->withInput()->with('error', 'There was an error processing your request. ' . $e->getMessage());
        }
    }
}
