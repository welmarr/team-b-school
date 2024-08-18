<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Secured\Admin\Api\ToolController as ApiToolController;
use App\Http\Controllers\Secured\Admin\Api\ToolTypeController as ApiToolTypeController;
use App\Http\Controllers\Secured\Admin\Api\UnitController as ApiUnitController;
use App\Http\Controllers\Unsecured\Api\DeleteTemporaryImageController;
use App\Http\Controllers\Unsecured\Api\UploadTemporaryImageController;
use App\Http\Controllers\Unsecured\Api\CarController as ApiCarController;
use App\Http\Controllers\Secured\Admin\UserController as AdminUserController;
use App\Http\Controllers\Secured\Admin\Api\RequestController as AdminRequestController;
use App\Http\Controllers\Secured\Dealer\Api\RequestController as DealerRequestController;

/**
 * API Routes
 *
 * This file defines the API routes for both secure and unsecure endpoints.
 */

// Secure API routes
Route::group(['as' => 'api.'], function () {
    Route::group(['prefix' => 'secure', 'as' => 'secure.'], function () {
        // User management routes
        Route::get('/users', [AdminUserController::class, 'indexDataTableApi'])->name('users');
        Route::post('/users/{user}/disable-or-enable', [AdminUserController::class,'enableDisableApi'])->name('users.disable.or.enable');
        Route::post('/users/store', [AdminUserController::class, 'storeApi'])->name('users.store');

        // Tool and unit management routes
        Route::apiResource('/tool-types', ApiToolTypeController::class);
        Route::apiResource('/units', ApiUnitController::class);

        // Tool and request listing routes
        Route::get('/tools', ApiToolController::class)->name('tools.index');
        Route::get('/requests', AdminRequestController::class)->name('requests.index');
        Route::get('/dealers/{id}/requests', [DealerRequestController::class, 'index'])->name('dealers.requests.index');
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
