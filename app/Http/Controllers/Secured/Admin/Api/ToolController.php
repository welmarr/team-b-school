<?php

namespace App\Http\Controllers\Secured\Admin\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Secured\ToolMovementRequest;
use App\Models\TTool;
use App\Models\TToolInventoryMovement;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ToolController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index()
    {

        return DataTables::eloquent(
            TTool::withSum([
                'inventories as qty' => function ($query) {
                    $query->where(function ($query) {
                        $query->whereNull('request_id')
                            ->orWhereHas('request', function ($query) {
                                $query->where('status', '!=', 'canceled');
                            });
                    });
                }
            ], 'quantity')->with(['type', 'unit'])
        )->toJson();
    }

    public function list()
    {
        try {
            $tools = TTool::all();

            return response()->json([
                'data' => $tools,
                'msg' => '',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'msg' => 'There was an error processing your request. ' . $e->getMessage(),
            ], 500);
        }
    }

    public function movement(ToolMovementRequest $request, int $id)
    {
        try {
            $tools = TTool::all();

            TToolInventoryMovement::create(['quantity' => ($request->action_type == 'scrap' ?  -1 * ($request->qty) : ($request->qty)), 'note' => $request->memo, 'type' => ($request->action_type == 'scrap' ? 'Scraped' : 'Added'), 'tool_id' => $id]);

            return response()->json([
                'data' => $tools,
                'msg' => ($request->action_type == 'scrap' ? $request->qty . " remove from inventory for scraping." : $request->qty . " added in to the inventory."),
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'data' => null,
                'msg' => 'There was an error processing your request. ' . $e->getMessage(),
            ], 500);
        }
    }
}
