<?php

namespace App\Http\Controllers\Unsecured;

use App\Http\Controllers\Controller;

/**
 * Class HomeController
 *
 * @package App\Http\Controllers\Unsecured
 */
class AccountCreatedPageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @return \Illuminate\View\View
     */
    public function __invoke()
    {
        return view('unsecured.pages.account-created',  ['activeMenu' => 'account-created']);
    }
}
