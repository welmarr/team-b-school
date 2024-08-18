<?php

namespace App\Http\Controllers\Secured\Dealer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('secured.pages.dealer.requests.requests',  ['activeMenu' => 'requests']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Pass any necessary data to the view
        return view('secured.pages.dealer.requests.createrequest');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
