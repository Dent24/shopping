<?php

use Illuminate\Support\Facades\Route;

Route::redirect('/', '/customer');

Route::get('/{path}', function () {
    return view('home');
})->where('path', '^((?!api).)*$');
