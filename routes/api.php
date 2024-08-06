<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Secured\Admin\UserController as AdminUserController;
use App\Http\Controllers\Unsecured\Api\DeleteTemporaryImageController;
use App\Http\Controllers\Unsecured\Api\UploadTemporaryImageController;
use App\Http\Controllers\Unsecured\Api\CarController as ApiCarController;
use App\Http\Controllers\Secured\Admin\RequestController as AdminRequestController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::group(['as' => 'api.'], function () {
    Route::group(['prefix' => 'secure', 'as' => 'secure.'], function () {
        Route::get('/users', [AdminUserController::class, 'indexDataTableApi'])->name('users');
        Route::post('/users/{user}/disable-or-enable', [AdminUserController::class,'enableDisable'])->name('users.disable.or.enable');
        Route::get('/requests', [AdminRequestController::class, 'indexDataTableApi'])->name('requests');

    });
});




Route::group(['as' => 'api.'], function () {
    Route::group(['prefix' => 'unsecure', 'as' => 'unsecure.'], function () {
        Route::get('/models/{brand}/in/{year}', [ApiCarController::class, 'getModelByBrandAndYear'])->name('model.by.brand.year');
        Route::post('/images/upload', UploadTemporaryImageController::class)->name('images.upload');
        Route::delete('/images/delete', DeleteTemporaryImageController::class)->name('images.delete');
    });
});
