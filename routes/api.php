<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\QrCodeCaptureController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;


Route::post('/', [AuthController::class, 'login'])->name('api.login');

Route::group(['middleware' => ['auth:sanctum']],function () {
    Route::resource('users', UserController::class);
    Route::post('logout/{user}', [AuthController::class, 'logout']);
    Route::post('capture/store', [QrCodeCaptureController::class, 'store']);
});
