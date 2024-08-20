<?php

namespace App\Http\Controllers\Unsecured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ForgotPasswordController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function submit(Request $request)
    {
        //
    }


    public function view()
    {
        return view('unsecured.pages.forgot-password');
    }

}
