<?php

namespace App\Http\Controllers\Unsecured;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers\Unsecured
 */
class HomePageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return view('unsecured.pages.home', ['activeMenu' => 'home']);
    }
}
