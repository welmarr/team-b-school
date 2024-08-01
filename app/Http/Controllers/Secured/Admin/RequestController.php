<?php

namespace App\Http\Controllers\Secured\Admin;


use Illuminate\Http\Request;
use App\Models\Request as Demand;
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
        return DataTables::eloquent(Demand::with(['make', 'model'])->select())
        ->toJson();
    }



    /**
     * Display the specified resource.
     */
    public function show(Demand $demand)
    {
        $activeMenu = "requests";
        return view('secured.pages.admin.requests.treatment', compact("demand", "activeMenu"));
    }
}
