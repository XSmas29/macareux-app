<?php

use App\Http\Controllers\PopulationController;
use App\Http\Controllers\PrefectureController;
use App\Http\Controllers\uploadController;
use App\Http\Controllers\YearController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/data', function () {
    return view('data');
})->name('data');

Route::post('/upload', [uploadController::class, 'uploadCSV']);
Route::get('/prefectures', [PrefectureController::class, 'getPrefectureList']);
Route::get('/years', [YearController::class, 'getYearList']);
Route::get('/population', [PopulationController::class, 'getPopulationData']);
