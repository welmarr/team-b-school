<?php

namespace App\Http\Controllers\Secured\Admin\Api;

use Carbon\Carbon;
use App\Models\TTool;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Secured\StoreToolRequest;

class ToolController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return DataTables::eloquent(TTool::withSum('inventories as qty', 'quantity')->with(["type", "unit"]))
            ->toJson();
    }
}
