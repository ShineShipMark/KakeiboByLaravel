<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\KakeiboController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::inertia('/input', '/input');
Route::get('/history', [HistoryController::class, 'getHistory']);
Route::post('/history', [HistoryController::class, 'getHistory'])->name('history');
Route::put('/history/{id}', [HistoryController::class, 'editData'])->name('edit');
Route::delete('/history/{id}', [HistoryController::class, 'deleteData'])->name('delete');
Route::post('/input', [InputController::class, 'inputData'])->name('input');