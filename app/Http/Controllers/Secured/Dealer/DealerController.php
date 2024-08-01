<?php

namespace App\Http\Controllers\Secured\Dealer;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Http\Requests\Secured\UpdateDealerProfileRequest;
use App\Http\Requests\Secured\StoreDealerProfileRequest;

class DealerController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(Dealer $dealer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Dealer $dealer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDealerProfileRequest $request, Dealer $dealer)
    {
        //
    }
}
