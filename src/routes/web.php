<?php

use App\Http\Controllers\KakeiboController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('/edit', [KakeiboController::class, 'renderPage'])->name('input');
Route::get('/edit', [KakeiboController::class, 'renderPage'])->name('edit');
Route::get('/history/expense', [KakeiboController::class, 'getExpense'])->name('history.expense');
Route::get('/history/income', [KakeiboController::class, 'getIncome'])->name('history.income');
Route::post('/input/expense', [KakeiboController::class, 'inputExpense'])->name('input.expense');
Route::post('/input/income', [KakeiboController::class, 'inputIncome'])->name('input.income');
Route::post('/edit/expense', [KakeiboController::class, 'editExpense'])->name('edit.expense');
Route::post('/edit/income', [KakeiboController::class, 'editIncome'])->name('edit.income');
Route::post('/delete/expense', [KakeiboController::class, 'deleteExpense'])->name('delete.expense');
Route::post('/delete/income', [KakeiboController::class, 'deleteIncome'])->name('delete.income');
Route::get('/get_expense_purpose',[KakeiboController::class, 'getExpensePurpose'])->name('get.expense_purpose');
Route::get('/get_income_purpose',[KakeiboController::class, 'getIncomePurpose'])->name('get.income_purpose');
Route::get('/get_expense_category',[KakeiboController::class, 'getExpenseCategory'])->name('get.expense_category');
Route::get('/get_income_category',[KakeiboController::class, 'getIncomeCategory'])->name('get.income_category');