<?php

namespace App\Http\Controllers\Secured\Dealer\Api;

use App\Http\Controllers\Controller;
use App\Models\TRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class RequestController extends Controller
{
    public function index(int $id)
    {
        $activeMenu = "requests";


        return DataTables::eloquent(TRequest::where('created_by_id', $id)->with(['car.brand', 'car.model', 'createdBy'])->select())
            ->escapeColumns(['created_by_id'])
            ->toJson();
    }

    // Other methods as required...

    public function show(int $id)
    {
        $activeMenu = "requests";
        $user = auth()->user(); // Get the currently authenticated user

        // Ensure the dealer only sees requests they own
        $demand = TRequest::where('id', $id)
            ->where('dealer_id', $user->id)
            ->with(['car.brand', 'car.model', 'createdBy'])
            ->firstOrFail();

        return view('secured.pages.dealer.requests.treatment', compact("demand", "activeMenu"));
    }

    // Additional methods...
}
