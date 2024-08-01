<?php

namespace App\Http\Controllers\Secured\Admin;

use App\Models\DealerUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\Secured\StoreDealerUserRequest;
use App\Http\Requests\Secured\UpdateDealerUserRequest;

class DealerUserController extends Controller
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
    public function store(StoreDealerUserRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(DealerUser $dealerUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DealerUser $dealerUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDealerUserRequest $request, DealerUser $dealerUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DealerUser $dealerUser)
    {
        //
    }
}
