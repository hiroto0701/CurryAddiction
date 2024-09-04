<?php

use App\Domains\ServiceUser\Controller\Resource\CurrentServiceUserResource;
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

// ユーザー情報関連
Route::prefix('/service_users')->group(function() {
    Route::post('/generate_token', \App\Domains\ServiceUser\Controller\GenerateAuthTokenAction::class);
    // 認証API
    Route::post('/login', \App\Domains\ServiceUser\Controller\LoginAction::class);
    // ユーザー新規登録
    Route::put('/register', \App\Domains\ServiceUser\Controller\RegisterAction::class);

    // リロード時ユーザー情報取得
    Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
        return new CurrentServiceUserResource($request->user());
    });

    Route::middleware(['auth:service_users'])->group(function() {
        Route::put('/avatar', \App\Domains\ServiceUser\Controller\UpdateAvatarAction::class);
        Route::put('/display_name', \App\Domains\ServiceUser\Controller\UpdateDisplayNameAction::class);
        Route::post('/logout', \App\Domains\ServiceUser\Controller\LogoutAction::class);
        Route::delete('/{service_user}', \App\Domains\ServiceUser\Controller\DeleteAction::class);
    });
});

// カレージャンル関連
Route::prefix('/genres')->middleware(['auth:service_users'])->group(function() {
    Route::get('/', \App\Domains\Genre\Controller\IndexAction::class);
});

// 投稿関連
Route::prefix('/posts')->middleware(['auth:service_users'])->group(function() {
    Route::get('/', \App\Domains\Post\Controller\IndexAction::class);
    Route::post('/', \App\Domains\Post\Controller\CreateAction::class);
    Route::post('/{post}/likes', \App\Domains\Post\Controller\LikeAction::class);
    Route::post('/{post}/archives', \App\Domains\Post\Controller\ArchiveAction::class);
    Route::get('/{post:slug}', \App\Domains\Post\Controller\ViewAction::class);
    Route::delete('/{post:slug}', \App\Domains\Post\Controller\DeleteAction::class);
});

// dashboard関連
Route::prefix('/dashboard')->middleware(['auth:service_users'])->group(function() {
    Route::prefix('/analytics')->group(function () {
        Route::get('/', \App\Domains\Dashboard\Analytics\Controller\IndexAction::class);
    });


    Route::prefix('/trash')->group(function() {
        Route::get('/', \App\Domains\Dashboard\Trash\Controller\IndexAction::class);
        Route::post('/{post:slug}', \App\Domains\Dashboard\Trash\Controller\RestoreAction::class)->withTrashed();
        Route::delete('/{post:slug}', \App\Domains\Dashboard\Trash\Controller\DeleteAction::class)->withTrashed();
    });
});

// ユーザー詳細ページ
// 注意: このルートはプレフィックスがないため、他のURL構造と競合する可能性があるので、なるべく下に定義する
Route::middleware(['auth:service_users'])->group(function() {
    Route::get('/{service_user:handle_name}', \App\Domains\ServiceUser\Controller\ViewAction::class);
});
