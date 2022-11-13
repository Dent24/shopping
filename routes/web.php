<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManageController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/customer');

Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::group(['prefix' => 'manage'], function () {
    Route::view('/', 'home')->middleware('auth');
    Route::view('login', 'home')->middleware('guest')->name('manage.login');

    Route::post('product', [ManageController::class, 'createProduct']);
});

Route::group(['prefix' => 'customer'], function () {
    Route::view('/', 'home');
});
