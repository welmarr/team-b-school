<?php

namespace App\Http\Controllers\Secured\Admin\Api;

use App\Models\TToolInventoryMovement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TImage;
use App\Models\TRequest;
use Yajra\DataTables\Facades\DataTables;

class RequestToolController extends Controller
{
    public function add(Request $request, int $demand_id)
    {
        $request->validate([
            'tool' => 'required|exists:t_tools,id',
            'qty' => 'required|integer|min:1',
        ]);

        try {
            $inventory = new TToolInventoryMovement();
            $inventory->tool_id = $request->input('tool');
            $inventory->quantity = -1 * (\abs($request->input('qty')));
            $inventory->type = 'Used';
            $inventory->request_id = $demand_id;
            $inventory->save();

            $inventory = TToolInventoryMovement::where('id', $inventory->id)->with(["tool", "request", "tool.unit"])->first();
            return response()->json([
                'data' => $inventory,
                'msg' => 'Tool usage added successfully!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Failed to add tool usage. ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $demand_id, $inventory_id)
    {
        //dd($demand_id, $inventory_id);

        $request->validate([
            'tool' => 'required|exists:t_tools,id',
            'qty' => 'required|integer|min:1',
        ]);

        try {
            $inventory = TToolInventoryMovement::findOrFail($inventory_id);
            $inventory->tool_id = $request->input('tool');
            $inventory->quantity = $request->input('qty');
            $inventory->save();

            $inventory = TToolInventoryMovement::where('id', $inventory->id)->with(["tool", "request"])->first();

            return response()->json([
                'data' => $inventory,
                'msg' => 'Tool usage updated successfully!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Failed to update tool usage. ' . $e->getMessage()
            ], 500);
        }
    }

    public function delete(int $request_id, int $inventory)
    {
        try {

            $inventory_data = TToolInventoryMovement::findOrFail($inventory);
            $inventory_data->delete();

            return response()->json([
                'msg' => 'Tool usage deleted successfully!',
                'data' => $inventory_data
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'msg' => 'Failed to delete tool usage. ' . $e->getMessage()
            ], 500);
        }
    }
}
