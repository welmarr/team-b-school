<?php

namespace App\Http\Controllers\Secured\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __invoke()
    {
        return view('secured.pages.admin.users', ['activeMenu' => 'users']);
    }

}
