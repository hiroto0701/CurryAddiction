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

// TODO
// ミドルウェアの設定
Route::get('/file/view/{type}/{uuid}', \App\Http\Controllers\FileViewAction::class)->name('file.view');
