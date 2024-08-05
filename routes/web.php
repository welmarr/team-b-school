<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Secured\ProfileController;
use App\Http\Controllers\Unsecured\LoginController;
use App\Http\Controllers\Unsecured\SignUpController;
use App\Http\Controllers\Unsecured\RequestController;
use App\Http\Controllers\Secured\Admin\ToolController;
use App\Http\Controllers\Secured\Admin\UserController;
use App\Http\Controllers\Secured\Admin\DealerController;
use App\Http\Controllers\Secured\Admin\ToolTypeController;
use App\Http\Controllers\Secured\Admin\FileDownloadController;
use App\Http\Controllers\Secured\Admin\ToolInventoryMovementController;
use App\Http\Controllers\Secured\Admin\RequestController as AdminRequestController;
use App\Http\Controllers\Secured\Dealer\DealerController as DealerProfileController;
use App\Http\Controllers\Secured\Dealer\RequestController as DealerRequestController;


/**
 * Define a route for the root URL that redirects to the unsecured home page
 */
Route::get('/', function () {
    return Redirect::route('unsecured.home');
});

/**
 * Group routes under the 'unsecured' namespace
 */
Route::group(['as' => 'unsecured.'], function () {

    /**
     * Define a route for the login page
     */
    Route::get('login', function () {
        return view('unsecured.pages.login');
    })->name('login');

    /**
     * Define a route for the sign-up page
     */
    Route::get('sign-up', function () {
        return view('unsecured.pages.sign-up');
    })->name('sign-up');

    /**
     * Define a route for the forgot-password page
     */
    Route::get('forgot-password', function () {
        return view('unsecured.pages.forgot-password');
    })->name('forgot-password');

    /**
     * Group routes under the 'ask-for' prefix and 'ask-for' namespace
     */
    Route::group(['prefix' => 'ask-for', 'as' => 'ask-for.'], function () {
        /**
         * Define a POST route for login
         */
        Route::post('/login', [LoginController::class, 'core'])->name('login');
        /**
         * Define a POST route for sign-up
         */
        Route::post('/sign-up', [SignUpController::class, 'core'])->name('sign-up');
    });

    /**
     * Define a route for the home page with an active tab parameter
     */
    Route::get('home', function () {
        return view('unsecured.pages.home', ['activeMenu' => 'home']);
    })->name('home');

    /**
     * Define a route for the get-estimate page with an active tab parameter
     */
    Route::get('get-estimate', function () {
        $brands = \App\Models\TCarBrand::all();
        $years = \App\Models\TCar::select('year')->distinct()->orderBy('year', 'desc')->get()->pluck('year');
        $states = USA_states();
        $activeMenu = 'get-estimate';
        return view('unsecured.pages.get-estimate', compact('brands', 'years', 'activeMenu', 'states'));
    })->name('get-estimate.index');

    /**
     * Define a POST route for get-estimate
     */
    Route::post('/get-estimate', RequestController::class)->name('get-estimate.post');

    /**
     * Define a route for the track-repair page with an active tab parameter
     */
    Route::get('track-repair', function () {
        return view('unsecured.pages.track-repair', ['activeMenu' => 'track-repair']);
    })->name('track-repair');

    /**
     * Define a route for the about page with an active tab parameter
     */
    Route::get('about', function () {
        return view('unsecured.pages.about',  ['activeMenu' => 'about']);
    })->name('about');

    /**
     * Define a route for the not-found page
     */
    Route::get('not-found', function () {
        return view('unsecured.pages.not-found');
    })->name('not-found');
});

/**
 * Group routes under the 'secured' prefix and 'secured' namespace
 */
Route::group(['prefix' => 'secured', 'as' => 'secured.'], function () {

    /**
     * Admin
     * All routes needed for admin functionalities.
     */
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        /**
         * Define a route for the admin dashboard
         */
        Route::get('dashboard', function () {

            $activeMenu = 'dashboard';
            $countUser = \App\Models\User::count();
            $countRequest = \App\Models\TRequest::count();
            return view('secured.pages.admin.dashboard',  compact("activeMenu", "countUser", "countRequest"));
        })->name('dashboard');

        Route::get('/download/file/{public_uri}', FileDownloadController::class);

        /**
         * Define resource routes for users
         */
        Route::resource('users', UserController::class);

        /**
         * Define resource routes for users
         */
        Route::resource('requests', AdminRequestController::class);

        /**
         * Define resource routes for dealers
         */
        Route::resource('dealers', DealerController::class);

        /**
         * Define resource routes for tool types
         */
        Route::resource('tools/types', ToolTypeController::class);

        /**
         * Define resource routes for tools
         */
        Route::resource('tools', ToolController::class);

        /**
         * Define resource routes for tool inventory movements with limited actions
         */
        Route::resource('tools.movements', ToolInventoryMovementController::class)->only([
            'index',
            'show'
        ]);

        /**
         * Define a singleton route for the profile
         */
        Route::singleton('profile', ProfileController::class);
        // TODO: Add route to handle the requests by admin
    });

    /**
     * Dealers
     * All routes needed for dealer functionalities.
     */
    Route::group(['prefix' => 'dealers', 'as' => 'dealers.'], function () {
        /**
         * Define a singleton route for the profile
         */
        Route::singleton('profile', ProfileController::class);

        /**
         * Define resource routes for dealer requests
         */
        Route::resource('requests', DealerRequestController::class);

        /**
         * Define resource routes for dealer profile entity
         */
        Route::resource('entity/profile', DealerProfileController::class);
    });
});

/**
 * Redirect to the not-found page for any undefined routes
 */
Route::fallback(function () {
    return Redirect::route('unsecured.not-found');
});
