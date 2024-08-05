<?php

namespace App\Http\Controllers\Unsecured;

use App\Http\Controllers\Controller;
use App\Http\Requests\Unsecured\LoginRequest;

class LoginController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function core(LoginRequest $request)
    {
        $validated = $request->validated();
        //dd($validated);
        return view('unsecured.login.store');
    }
}
