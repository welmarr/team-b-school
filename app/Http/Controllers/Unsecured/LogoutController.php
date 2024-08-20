<?php

namespace App\Http\Controllers\Unsecured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        if(Auth::check()){
            Auth::logout();
        }

        return redirect()->route("login");
    }
}
