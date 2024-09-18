<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\DeviceController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorizationController;

Route::post('login', [AuthorizationController::class, 'login'])->name('login');

Route::group(['middleware' => ['auth:sanctum']], function () {
  Route::get('me', [AuthorizationController::class, 'me'])->name('me');
  Route::post('logout', [AuthorizationController::class, 'logout'])->name('logout');
  Route::apiResource('posts', PostController::class);
  Route::apiResource('user', UserController::class);
  Route::post('account/password', [AccountController::class, 'password'])->name('account.password');

  Route::post('devices/disconnect', [DeviceController::class, 'deviceDisconnect'])->name('devices.disconnect');
  Route::get('devices', [DeviceController::class, 'devices'])->name('devices');
});
