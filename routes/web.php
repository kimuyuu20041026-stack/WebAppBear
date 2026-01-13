<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\MunicipalityController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'show']);

//住民用システムUIで利用するもの。今回は見れるように利用してないが、Route::middleware(['auth'])->group(function () 
//などの認証が必要なものを利用する必要がある
Route::get('/login', [LoginController::class, 'login'])->name('login');
// ログイン認証処理（POST）
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
// 熊の通報
Route::post('/bear/report', [InfoController::class, 'store'])->name('bear.report.store');
// チャット
Route::post('/bear/chat/send', [InfoController::class, 'sendMessage'])->name('bear.chat.send');

/*
自治体用システムコントローラー
*/
// 自治体管理画面
Route::get('/municipality', [MunicipalityController::class, 'index'])->name('municipality.index');
// 通報管理
Route::post('/municipality/reports/{id}/status', [MunicipalityController::class, 'updateReportStatus'])->name('municipality.reports.status');
// 駆除依頼管理
Route::post('/municipality/hunting-requests', [MunicipalityController::class, 'storeHuntingRequest'])->name('municipality.hunting.store');
// チャット
Route::post('/municipality/chat/{threadId}/message', [MunicipalityController::class, 'sendMessage'])->name('municipality.chat.send');

