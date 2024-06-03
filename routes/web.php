<?php

use App\Http\Controllers\MyController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', [MyController::class, 'index']);

Route::get('/contact', function () {
    return view('contact');
});
