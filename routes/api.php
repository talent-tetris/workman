<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthorizationController;

Route::post('login', [AuthorizationController::class, 'login'])->name('login');
Route::post('refresh', [AuthorizationController::class, 'refresh'])->name('refresh.token');

Route::group(['middleware' => ['auth:api']], function () {
  Route::get('me', [AuthorizationController::class, 'me'])->name('me');
  Route::post('logout', [AuthorizationController::class, 'logout'])->name('logout');
});
