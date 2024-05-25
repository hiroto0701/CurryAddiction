<?php

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
    Route::post('/generate_token', \App\Domains\ServiceUser\Controller\GenerateAuthTokenAction::class);
    // 認証API
    Route::post('/login', \App\Domains\ServiceUser\Controller\LoginAction::class);
    // ユーザー新規登録
    Route::put('/register', \App\Domains\ServiceUser\Controller\RegisterAction::class);
    Route::middleware((['auth:sanctum', 'auth:service_users']))->group(function() {
        Route::get('/user', \App\Domains\ServiceUser\Controller\GetAction::class);
        Route::put('/avatar', \App\Domains\ServiceUser\Controller\UpdateAvatarAction::class);
        Route::put('/display_name', \App\Domains\ServiceUser\Controller\UpdateDisplayNameAction::class);
        Route::post('/logout', \App\Domains\ServiceUser\Controller\LogoutAction::class);
    });
});
