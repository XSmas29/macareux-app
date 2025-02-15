<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/data', function () {
    return view('data');
})->name('data');

Route::post('/upload', [AppController::class, 'uploadCSV']);
