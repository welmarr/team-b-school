<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Middleware\ShareDataMiddleware;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Controllers\Secured\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Unsecured\LoginController;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Controllers\Unsecured\LogoutController;
use App\Http\Controllers\Unsecured\SignUpController;
use App\Http\Controllers\Unsecured\RequestController;
use App\Http\Controllers\Secured\Admin\ToolController;
use App\Http\Controllers\Secured\Admin\UnitController;
use App\Http\Controllers\Secured\Admin\UserController;
use App\Http\Controllers\Secured\Admin\DealerController;
use App\Http\Controllers\Secured\Admin\ToolTypeController;
use App\Http\Controllers\Secured\Admin\FileDownloadController;
use App\Http\Controllers\Secured\Admin\ToolInventoryMovementController;
use App\Http\Controllers\Secured\Admin\RequestController as AdminRequestController;
use App\Http\Controllers\Secured\Dealer\ProfileController as DealerProfileController;
use App\Http\Controllers\Secured\Dealer\RequestController as DealerRequestController;

/**
 * Web Routes
 *
 * This file defines the web routes for the application.
 * It includes routes for both unsecured (public) and secured (authenticated) areas.
 */

/**
 * Redirect the root URL to the unsecured home page
 */
Route::get('/', function () {
    return Redirect::route('unsecured.home');
});

/**
 * Unsecured Routes
 *
 * These routes are accessible without authentication.
 */


 Route::get('unsecured/login', function () {
    return view('unsecured.pages.login');
})->name('login');

Route::group(['as' => 'unsecured.'], function () {

    // Authentication routes

    Route::get('logout', LogoutController::class)->name('logout')->middleware(['auth']);

    Route::get('sign-up', function () {
        return view('unsecured.pages.sign-up');
    })->name('sign-up');

    Route::get('forgot-password', function () {
        return view('unsecured.pages.forgot-password');
    })->name('forgot-password');

    // Authentication action routes
    Route::group(['prefix' => 'ask-for', 'as' => 'ask-for.'], function () {
        Route::post('/login', [LoginController::class, 'core'])->name('login');
        Route::post('/sign-up', [SignUpController::class, 'core'])->name('sign-up');
    });

    // Public pages
    Route::get('home', function () {
        return view('unsecured.pages.home', ['activeMenu' => 'home']);
    })->name('home');

    Route::get('get-estimate', function () {
        $brands = \App\Models\TCarBrand::all();
        $years = \App\Models\TCar::select('year')->distinct()->orderBy('year', 'desc')->get()->pluck('year');
        $states = USA_states();
        $activeMenu = 'get-estimate';
        return view('unsecured.pages.get-estimate', compact('brands', 'years', 'activeMenu', 'states'));
    })->name('get-estimate.index');

    Route::post('/get-estimate', RequestController::class)->name('get-estimate.post');

    Route::get('track-repair', function () {
        return view('unsecured.pages.track-repair', ['activeMenu' => 'track-repair']);
    })->name('track-repair');

    Route::get('about', function () {
        return view('unsecured.pages.about',  ['activeMenu' => 'about']);
    })->name('about');

    Route::get('not-found', function () {
        return view('unsecured.pages.not-found');
    })->name('not-found');
});

/**
 * Secured Routes
 *
 * These routes require authentication to access.
 */
Route::group(['prefix' => 'secured', 'as' => 'secured.', 'middleware' => 'auth'], function () {

    /**
     * Admin Routes
     *
     * Routes for admin functionalities.
     */
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::middleware([ShareDataMiddleware::class])->group(function () {

            // Admin dashboard
            Route::get('dashboard', function () {
                $activeMenu = 'dashboard';
                $countUser = \App\Models\User::count();
                $countRequest = \App\Models\TRequest::count();
                $countUnit = \App\Models\TUnit::count();
                $countTool = \App\Models\TTool::count();
                $countToolType = \App\Models\TToolType::count();
                return view('secured.pages.admin.dashboard',  compact("activeMenu", "countUser", "countRequest", "countUnit", "countTool", "countToolType"));
            })->name('dashboard');

            // Resource routes
            Route::resource('users', UserController::class);
            Route::resource('requests', AdminRequestController::class);
            Route::resource('dealers', DealerController::class);
            Route::get('tool-types', ToolTypeController::class)->name('tool-types.index');
            Route::get('units', UnitController::class)->name('units.index');
            Route::resource('tools', ToolController::class);
        });

        // File download route
        Route::get('/download/file/{public_uri}', FileDownloadController::class);

        // Tool inventory movements
        Route::resource('tools.movements', ToolInventoryMovementController::class)->only([
            'index',
            'show'
        ]);

        // Admin profile

        Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update', [AdminProfileController::class, 'update'])->name('profile.update');

    });

    /**
     * Dealer Routes
     *
     * Routes for dealer functionalities.
     */
    Route::group(['prefix' => 'dealers', 'as' => 'dealers.'], function () {
        Route::get('dashboard', function () {
            $activeMenu = 'dashboard';
            $countRequest = \App\Models\TRequest::count();
            return view('secured.pages.admin.dashboard',  compact("activeMenu",  "countRequest", ));
        })->name('dashboard');
        Route::get('/profile', [DealerProfileController::class, 'index'])->name('profile.index');
        Route::put('/profile/update', [DealerProfileController::class, 'update'])->name('profile.update');
        Route::resource('requests', DealerRequestController::class);
        Route::resource('entity/profile', DealerProfileController::class);
    });
});

/**
 * Fallback Route
 *
 * Redirect to the not-found page for any undefined routes.
 */
Route::fallback(function () {
    return Redirect::route('unsecured.not-found');
});
