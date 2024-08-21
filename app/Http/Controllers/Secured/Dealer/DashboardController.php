<?php

namespace App\Http\Controllers\Secured\Dealer;

use App\Models\User;
use App\Models\TRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $activeMenu = 'dashboard';


        $countRequest = TRequest::where('created_by_id', Auth::user()->id)->where('created_by_type', User::class)->count();
        //dd($countRequest);
        return view('secured.pages.dealer.dashboard',  compact("activeMenu", "countRequest"));
    }
}
