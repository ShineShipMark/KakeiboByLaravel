<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\DTO\FindExpenseDTO;
use App\DTO\FindIncomeDTO;
use App\DTO\UpdateExpenseDTO;
use App\DTO\UpdateIncomeDTO;
use App\Http\Requests\HistoryRequest;
use App\UseCases\FindExpense;
use App\UseCases\FindIncome;
use App\UseCases\UpdateExpense;
use App\UseCases\UpdateIncome;
use App\UseCases\DeleteExpense;
use App\UseCases\DeleteIncome;

class HistoryController extends Controller
{
    public function index(HistoryRequest $request, FindExpense $expenseUsecase, FindIncome $incomeUsecase) {
        $expenditure = $request->input('expenditure', 'Expense');
        if ($expenditure === 'Expense') {
            $dataDTO = FindExpenseDTO::fromRequest($request);
            $searchedData = $expenseUsecase->handle($dataDTO);
        } else {
            $dataDTO = FindIncomeDTO::fromRequest($request);
            $searchedData = $incomeUsecase->handle($dataDTO);
        }

        return Inertia::render('History/', ['searchedData' => $searchedData]);
    }

    public function update(int $id, HistoryRequest $request, UpdateExpense $expenseUsecase, UpdateIncome $incomeUsecase)
    {
        $expenditure = $request->input('expenditure', 'Expense');
        
        if ($expenditure === 'Expense') {
            $updateDTO = UpdateExpenseDTO::fromRequest($id, $request);
            $expenseUsecase->handle($updateDTO);
        } else {
            $updateDTO=UpdateIncomeDTO::fromRequest($id, $request);
            $incomeUsecase->handle($updateDTO);
        }

        return back()->with('message', '更新が完了しました');
    }

    public function destroy(int $id, HistoryRequest $request, DeleteExpense $expenseUsecase, DeleteIncome $incomeUsecase) 
    {
        $expenditure = $request->input('expenditure', 'Expense');
        
        if ($expenditure === 'Expense') {
            $expenseUsecase->handle($id);
        } else {
            $incomeUsecase->handle($id);
        }

        return back()->with('message', '削除が完了しました');
    }
}
