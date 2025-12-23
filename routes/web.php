<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\InfoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'show']);

//住民用UIで利用するもの。今回は見れるように利用してないが、Route::middleware(['auth'])->group(function () 
//などの認証が必要なものを利用する必要がある
Route::get('/login', [LoginController::class, 'login'])->name('login');
// 熊の通報
Route::post('/bear/report', [InfoController::class, 'store'])->name('bear.report.store');
// チャット
Route::post('/bear/chat/send', [InfoController::class, 'sendMessage'])->name('bear.chat.send');