<?php

namespace App\Http\Controllers\Secured\Admin;

use App\Http\Controllers\Controller;

class UnitController extends Controller
{

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return view('secured.pages.admin.units', ['activeMenu' => 'units']);
    }

}
