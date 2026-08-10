<?php

use App\Http\Controllers\HistoryController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::resource('transactions', TransactionController::class);

Route::get('/input',[InputController::class, 'index'])->name('input.index');
Route::post('/input', [InputController::class, 'store'])->name('input.store');
Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
Route::put('/history/{id}', [HistoryController::class, 'update'])->name('history.update');
Route::delete('/history/{id}', [HistoryController::class, 'destroy'])->name('history.destroy');
Route::get('/api/masters', [MasterController::class, 'index'])->name('api.masters');
