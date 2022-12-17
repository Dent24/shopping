<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ManageController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/customer');

Route::view('login', 'home')->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);

Route::view('register', 'home')->middleware('guest')->name('register');
Route::post('register', [LoginController::class, 'register']);

Route::group(['prefix' => 'manage'], function () {
    Route::view('/', 'home')->middleware('auth')->name('manage.home');

    Route::get('products', [ManageController::class, 'getProducts']);
    Route::post('product', [ManageController::class, 'updateOrCreateProduct']);
    Route::delete('product/{id}', [ManageController::class, 'deleteProduct']);
});

Route::group(['prefix' => 'customer'], function () {
    Route::view('/', 'home')->name('customer.home');

    Route::get('products', [CustomerController::class, 'getProducts']);
});
