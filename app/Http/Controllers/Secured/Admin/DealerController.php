<?php

namespace App\Http\Controllers\Secured\Admin;

use App\Models\Dealer;
use App\Http\Controllers\Controller;
use App\Http\Requests\Secured\StoreDealerRequest;
use App\Http\Requests\Secured\UpdateDealerRequest;

class DealerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDealerRequest $request)
    {
        //
    }

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
    public function update(UpdateDealerRequest $request, Dealer $dealer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dealer $dealer)
    {
        //
    }
}
