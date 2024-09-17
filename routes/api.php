<?php

use App\Http\Controllers\Api\AccountController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorizationController;

Route::post('login', [AuthorizationController::class, 'login'])->name('login');
Route::post('refresh', [AuthorizationController::class, 'refresh'])->name('refresh_token');

Route::group(['middleware' => ['auth:api']], function () {
  Route::get('me', [AuthorizationController::class, 'me'])->name('me');
  Route::post('logout', [AuthorizationController::class, 'logout'])->name('logout');
  Route::apiResource('posts', PostController::class);
  Route::apiResource('user', UserController::class);
  Route::post('account/password', [AccountController::class, 'password'])->name('account.password');
});
