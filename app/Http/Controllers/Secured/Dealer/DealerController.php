<?php

namespace App\Http\Controllers\Secured\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Http\Requests\Secured\UpdateDealerProfileRequest;
use App\Http\Requests\Secured\StoreDealerProfileRequest;

class DealerController extends Controller
{

    public function index()
    {
        return view('secured.pages.dealers.profile');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDealerProfileRequest $request, Dealer $dealer)
    {
        //
    }
}
