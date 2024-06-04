<?php

use App\Domains\ServiceUser\Controller\Resource\ServiceUserResource;
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
    Route::post('/generate_token', \App\Domains\ServiceUser\Controller\GenerateAuthTokenAction::class);
    // 認証API
    Route::post('/login', \App\Domains\ServiceUser\Controller\LoginAction::class);
    // ユーザー新規登録
    Route::put('/register', \App\Domains\ServiceUser\Controller\RegisterAction::class);

    // リロード時ユーザー情報取得
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return new ServiceUserResource($request->user());
    });

    Route::middleware((['auth:service_users']))->group(function() {
        Route::put('/avatar', \App\Domains\ServiceUser\Controller\UpdateAvatarAction::class);
        Route::put('/display_name', \App\Domains\ServiceUser\Controller\UpdateDisplayNameAction::class);
        Route::post('/', \App\Domains\ServiceUser\Controller\LogoutAction::class);
        Route::post('/logout', \App\Domains\ServiceUser\Controller\LogoutAction::class);
    });
});

Route::prefix('/posts')->group(function() {
    Route::middleware((['auth:service_users']))->group(function() {
        Route::post('/', \App\Domains\Post\Controller\CreateAction::class);
    });
});