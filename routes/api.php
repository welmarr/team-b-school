<?php

use Illuminate\Support\Facades\Route;

// Admin Controllers
use App\Http\Controllers\Secured\Admin\Api\RequestController as AdminRequestController;
use App\Http\Controllers\Secured\Admin\Api\RequestToolController as AdminRequestToolController;
use App\Http\Controllers\Secured\Admin\Api\ToolController as ApiToolController;
use App\Http\Controllers\Secured\Admin\Api\ToolTypeController as ApiToolTypeController;
use App\Http\Controllers\Secured\Admin\Api\UnitController as ApiUnitController;
use App\Http\Controllers\Secured\Admin\Api\UserController as AdminUserController;

// Dealer Controllers
use App\Http\Controllers\Secured\Dealer\Api\RequestController as DealerRequestController;

// Unsecured Controllers
use App\Http\Controllers\Unsecured\Api\CarController as ApiCarController;
use App\Http\Controllers\Unsecured\Api\DeleteTemporaryImageController;
use App\Http\Controllers\Unsecured\Api\UploadTemporaryImageController;

/**
 * API Routes
 *
 * This file defines the API routes for both secure and unsecure endpoints.
 */

// Secure API routes
Route::group(['as' => 'api.'], function () {
    Route::group(['prefix' => 'secure', 'as' => 'secure.'], function () {

        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
            // Users listing routes
            Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
            Route::post('/users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggleStatus');
            Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');

            // Unit listing routes
            Route::apiResource('/units', ApiUnitController::class);


            // Tool type listing routes
            Route::apiResource('/tool-types', ApiToolTypeController::class);

            // Tool listing routes
            Route::get('/tools', [ApiToolController::class, 'index'])->name('tools.index');
            Route::get('/tools/list', [ApiToolController::class, 'list'])->name('tools.list');
            Route::post('/tools/{id}/movement', [ApiToolController::class, 'movement'])->name('tools.movement');

            // Request listing routes
            Route::get('/requests', [AdminRequestController::class, 'index'])->name('requests.index');
            Route::get('/requests/appointments/dashboard', [AdminRequestController::class, 'dashboardListAppointment'])->name('requests.dashboard.appointment.list');
            Route::get('/requests/dashboard', [AdminRequestController::class, 'dashboardListRequest'])->name('requests.dashboard.list');
            Route::post('/requests/{request_id}/tools/usage', [AdminRequestToolController::class, 'add'])->name('requests.tools.usage.add');
            Route::put('/requests/{request_id}/tools/usage/{inventory}/update', [AdminRequestToolController::class, 'update'])->name('requests.tools.usage.update');
            Route::delete('/requests/{request_id}/tools/usage/{inventory}/delete', [AdminRequestToolController::class, 'delete'])->name('requests.tools.usage.delete');
            Route::get('/requests/{id}/images', [AdminRequestController::class, 'images'])->name('requests.images');
        });

        Route::group(['prefix' => 'dealer', 'as' => 'dealer.'], function () {
            // Request listing routes
            Route::get('/{user_id}/requests', [DealerRequestController::class, 'index'])->name('requests.index');
            Route::get('/{user_id}/requests/appointments/dashboard', [DealerRequestController::class, 'dashboardListAppointment'])->name('requests.dashboard.appointment.list');
            Route::get('/{user_id}/requests/dashboard', [DealerRequestController::class, 'dashboardListRequest'])->name('requests.dashboard.list');
            Route::get('/requests/{id}/images', [DealerRequestController::class, 'images'])->name('requests.images');
        });
    });
});

// Unsecure API routes
Route::group(['as' => 'api.'], function () {
    Route::group(['prefix' => 'unsecure', 'as' => 'unsecure.'], function () {
        // Car model retrieval route
        Route::get('/models/{brand}/in/{year}', ApiCarController::class)->name('model.by.brand.year');

        // Temporary image management routes
        Route::post('/images/upload', UploadTemporaryImageController::class)->name('images.upload');
        Route::delete('/images/delete', DeleteTemporaryImageController::class)->name('images.delete');
    });
});
