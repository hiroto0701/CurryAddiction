<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('/login', \App\Domains\ServiceUser\Controller\LoginAction::class);
Route::middleware('auth:service_users')->group(function() {
    Route::post('/logout', \App\Domains\ServiceUser\Controller\LogoutAction::class);
});

