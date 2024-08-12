<?php

namespace App\Http\Controllers\Secured\Admin\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TRequest;
use Yajra\DataTables\Facades\DataTables;

class RequestController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return DataTables::eloquent(TRequest::with(['car.brand', 'car.model', 'createdBy'])->select())
        ->escapeColumns(['created_by_id'])
        ->toJson();
    }

}
