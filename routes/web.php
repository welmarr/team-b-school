<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Middleware\ShareDataMiddleware;
use App\Http\Controllers\Unsecured\LoginController;
use App\Http\Controllers\Unsecured\LogoutController;
use App\Http\Controllers\Unsecured\SignUpController;
use App\Http\Controllers\Unsecured\HomePageController;
use App\Http\Controllers\Unsecured\AboutPageController;
use App\Http\Controllers\Secured\Sharing\ProfileController;
use App\Http\Controllers\Unsecured\ValidateEmailController;
use App\Http\Controllers\Secured\Dealer\DashboardController as DealerDashboardController;
use App\Http\Controllers\Unsecured\ForgotPasswordController;
use App\Http\Controllers\Unsecured\GetEstimatePageController;
use App\Http\Controllers\Unsecured\TrackRepairPageController;
use App\Http\Controllers\Unsecured\AccountCreatedPageController;
use App\Http\Controllers\Secured\Admin\ToolController as AdminToolController;
use App\Http\Controllers\Secured\Admin\UnitController as AdminUnitController;
use App\Http\Controllers\Secured\Admin\UserController as AdminUserController;
use App\Http\Controllers\Secured\Sharing\UserController as SharingUserController;
use App\Http\Controllers\Secured\Admin\RequestController as AdminRequestController;
use App\Http\Controllers\Unsecured\RequestController as UnsecuredRequestController;
use App\Http\Controllers\Secured\Dealer\DealerController as DealerProfileController;
use App\Http\Controllers\Secured\Admin\ToolTypeController as AdminToolTypeController;
use App\Http\Controllers\Secured\Dealer\RequestController as DealerRequestController;
use App\Http\Controllers\Secured\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Secured\Admin\DownloadImageController as AdminDownloadImageController;

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
    return Redirect::route('home');
});

Route::get('/email/verify/{id}/{hash}', ValidateEmailController::class)->name('email.validation');

/**
 * Unsecured Routes
 *
 * These routes are accessible without authentication.
 */

// Home page
Route::get('/home', HomePageController::class)->name('home');

// About page
Route::get('/about', AboutPageController::class)->name('about');

// Track repair page
Route::get('/track-repair', TrackRepairPageController::class)->name('track-repair.view');

// Get estimate page and submission
Route::get('/get-estimate', [GetEstimatePageController::class, 'view'])->name('get-estimate.view');
Route::post('/get-estimate',  [GetEstimatePageController::class, 'submit'])->name('get-estimate.submit');

// Authentication routes
Route::get('/login', [LoginController::class, 'view'])->name('login');
Route::post('/login', [LoginController::class, 'submit'])->name('login.submit');
Route::get('/sign-up',  [SignUpController::class, 'view'])->name('sign-up');
Route::post('/sign-up', [SignUpController::class, 'submit'])->name('sign-up.submit');
Route::get('logout', LogoutController::class)->name('logout')->middleware(['auth']);

// Password reset
Route::get('/forgot-password', [ForgotPasswordController::class, 'view'])->name('forgot-password.view');
Route::post('/forgot-password', [ForgotPasswordController::class, 'submit'])->name('forgot-password.submit');

// Account created confirmation
Route::get('/account-created', AccountCreatedPageController::class)->name('account-created');

// Not found page
Route::get('not-found', function () {
    return view('unsecured.pages.not-found');
})->name('not-found');

// Estimation acceptance and cancellation
Route::get('/estimation/{reference}/accept', [UnsecuredRequestController::class, 'accepted'])->name('request.estimation.accepted');
Route::get('/estimation/{reference}/cancel', [UnsecuredRequestController::class, 'canceled'])->name('request.estimation.canceled');
Route::post('/estimation/{reference}/appointment', [UnsecuredRequestController::class, 'appointment'])->name('request.estimation.appointment');


/**
 * Secured Routes
 *
 * These routes require authentication to access.
 */
Route::group(['prefix' => 'secured', 'as' => 'secured.', 'middleware' => ['auth']], function () {

    /**
     * Admin Routes
     *
     * Routes for admin functionalities.
     */
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {



        Route::get('/initial-setup', [SharingUserController::class, 'initialSetupView'])->name('initialSetupView');
        Route::post('/initial-setup', [SharingUserController::class, 'initialSetupCreate'])->name('initialSetupCreate');

        Route::middleware([ShareDataMiddleware::class, \App\Http\Middleware\AuthenticateMiddleware::class])->group(function () {

            // Admin dashboard
            Route::get('dashboard', AdminDashboardController::class)->name('dashboard');

            // Resource routes
            Route::get('/requests', [AdminRequestController::class, 'index'])->name('requests.index');
            Route::post('/requests/{id}/estimating', [AdminRequestController::class, 'estimating'])->name('requests.estimate.submit');
            Route::get('/requests/{id}', [AdminRequestController::class, 'show'])->name('requests.show');
            Route::post('/requests/{id}/appointment', [AdminRequestController::class, 'appointment'])->name('request.estimation.appointment');
            Route::post('/requests/{id}/start', [AdminRequestController::class, 'start'])->name('request.start');
            Route::post('/requests/{id}/complete', [AdminRequestController::class, 'complete'])->name('request.complete');


            Route::get('/requests/{id}/invoice', function ($id) {
                $demand = \App\Models\TRequest::find($id);
                return view('secured.pages.admin.invoice-print', compact(["demand"]));
            })->name('request.invoice');


            Route::get('tool-types', AdminToolTypeController::class)->name('tool-types.index');
            Route::get('units', AdminUnitController::class)->name('units.index');
            Route::resource('tools', AdminToolController::class);
            Route::get('users', AdminUserController::class)->name('users.index');

            // Admin profile
            Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view');
            Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        });

        // File download route
        Route::get('/file/{public_uri}', AdminDownloadImageController::class)->name('file.download');

    });

    /**
     * Dealer Routes
     *
     * Routes for dealer functionalities.
     */
    Route::group(['prefix' => 'dealers', 'as' => 'dealers.'], function () {

        Route::get('dashboard', DealerDashboardController::class)->name('dashboard');
        Route::resource('requests', DealerRequestController::class);
        Route::get('/profile', [ProfileController::class, 'view'])->name('profile.view');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/dealership/update', [ProfileController::class, 'updateDealerShip'])->name('profile.dealership.update');
    });
});

/**
 * Fallback Route
 *
 * Redirect to the not-found page for any undefined routes.
 */
Route::fallback(function () {
    return Redirect::route('not-found');
});
