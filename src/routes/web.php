<?php

use App\Http\Controllers\KakeiboController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/input', [KakeiboController::class, 'renderPage']);
Route::get('/edit', [KakeiboController::class, 'renderPage']);
Roure::get('/history', [KakeiboController::class, 'getHistory']);
Route::post('/history', [KakeiboController::class, 'getHistory'])->name('history');
Route::post('/input', [KakeiboController::class, 'inputData'])->name('input');
Route::post('/edit/{id}', [KakeiboController::class, 'editData'])->name('edit');
Route::delete('/history/{id}', [KakeiboController::class], 'deleteData')-name('delete');
Route::post('/delete/expense', [KakeiboController::class, 'deleteExpense'])->name('delete.expense');
Route::post('/delete/income', [KakeiboController::class, 'deleteIncome'])->name('delete.income');
Route::get('/get_expense_purpose',[KakeiboController::class, 'getExpensePurpose'])->name('get.expense_purpose');
Route::get('/get_income_purpose',[KakeiboController::class, 'getIncomePurpose'])->name('get.income_purpose');
Route::get('/get_expense_category',[KakeiboController::class, 'getExpenseCategory'])->name('get.expense_category');
Route::get('/get_income_category',[KakeiboController::class, 'getIncomeCategory'])->name('get.income_category');