<?php

use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/customer');

Route::group(['prefix' => 'manage'], function () {
    Route::view('/', 'home');
    Route::view('login', 'home');
    Route::get('test', [LoginController::class, 'test']);
    Route::post('login', [LoginController::class, 'login']);
});

Route::group(['prefix' => 'customer'], function () {
    Route::view('/', 'home');
});
