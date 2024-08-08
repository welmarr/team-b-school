<?php

namespace App\Http\Controllers\Secured\Admin;


use Illuminate\Http\Request;
use App\Models\TRequest as Demand;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('secured.pages.admin.requests.index',  ['activeMenu' => 'requests']);
    }


    /**
     * Display a listing of the resource.
     */
    public function indexDataTableApi(Request $request)
    {
        return DataTables::eloquent(Demand::with(['car.brand', 'car.model', 'createdBy'])->select())
        ->escapeColumns(['created_by_id'])
        ->toJson();
    }



    /**
     * Display the specified resource.
     */
    public function show(Demand $demand)
    {
        $activeMenu = "requests";
        $demand->with(['car.brand', 'car.model', 'createdBy']);
        return view('secured.pages.admin.requests.treatment', compact("demand", "activeMenu"));
    }
}
