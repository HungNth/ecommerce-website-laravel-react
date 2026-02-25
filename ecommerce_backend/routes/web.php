<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\SizeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AdminController::class, 'login'])->name('admin.login');
Route::post('admin/auth', [AdminController::class, 'auth'])->name('admin.auth');

Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('index');
    Route::post('logout', [AdminController::class, 'logout'])->name('logout');
    // colors routes
    Route::resource('colors', ColorController::class)->except('show');
    // sizes routes
    Route::resource('sizes', SizeController::class)->except('show');
    // coupons routes
    Route::resource('coupons', CouponController::class)->except('show');
});
