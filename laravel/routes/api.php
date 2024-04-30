<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('/service_users')->group(function() {
    // 認証API
    Route::post('/login', \App\Domains\ServiceUser\Controller\LoginAction::class);
    Route::middleware(('auth:service_users'))->group(function() {
        Route::post('/logout', \App\Domains\ServiceUser\Controller\LogoutAction::class);
    });
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
