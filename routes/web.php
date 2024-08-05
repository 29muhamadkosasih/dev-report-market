<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\StaterkitController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\bEmailController;
use App\Http\Controllers\bWhatshAppController;
use App\Http\Controllers\CoordinationController;
use App\Http\Controllers\NewClientCallController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QLSendController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\VisitController;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('home', [StaterkitController::class, 'home'])->name('home');
    Route::get('lang/{locale}', [LanguageController::class, 'swap']);
    Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout.empty');
    Route::get('layouts/empty', [StaterkitController::class, 'layout_empty'])->name('layout.empty');
    Route::get('report/pdf', [ReportController::class, 'pdf']);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('visit', VisitController::class);
    Route::resource('new-client-call', NewClientCallController::class);
    Route::resource('quotation-letter', QLSendController::class);
    Route::resource('blasting-email', bEmailController::class);
    Route::resource('blasting-whatsapp', bWhatshAppController::class);
    Route::resource('orders', OrderController::class);
    Route::resource('report', ReportController::class);
    Route::resource('coordination', CoordinationController::class);
});