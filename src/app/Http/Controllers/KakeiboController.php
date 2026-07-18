<?php

namespace App\Http\Controllers;

use App\DTO\FindExpenseDTO;
use App\DTO\FindIncomeDTO;
use App\DTO\RegisterExpenseDTO;
use App\DTO\RegisterIncomeDTO;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\UseCases\DeleteExpense;
use App\UseCases\DeleteIncome;
use App\UseCases\FindExpense;
use App\UseCases\FindIncome;
use App\UseCases\GetExpense;
use App\UseCases\GetExpenseCategory;
use App\UseCases\GetExpensePurpose;
use App\UseCases\GetIncome;
use App\UseCases\GetIncomeCategory;
use App\UseCases\GetIncomePurpose;
use App\UseCases\RegisterExpense;
use App\UseCases\UpdateExpense;
use Illuminate\Support\Arr;
use App\UseCases\RegisterIncome;
use App\UseCases\UpdateIncome;

class KakeiboController extends Controller
{

    public function renderPage(Request $resuest)
    {
        $pageName = $resuest->segment(1);
        
        return Inertia::render($pageName,[]);
    }

    public function getHistory(Request $request,FindExpense $expenseUsecase, FindIncome $incomeUseca) {
        $expenditure = $request->input('expenditure', 'Expense');
        if ($expenditure === 'Expense') {
            $dataDTO=FindExpenseDTO::fromRequest($request);
            $searchedData = $expenseUsecase->handle($dataDTO);
        } else {
            $dataDTO=FindIncomeDTO::fromRequest($request);
            $searchedData = $incomeUsecase->handle($dataDTO);
        }

        return Inertia::render('History/', ['searchedData' => $searchedData]);

    }

    public function inputData(Request $request, RegisterExpense $expenseUsecase, RegisterIncome $incomeUsecase)
    {
        $expenditure = $request->input('expenditure', 'Expense');
        
        if ($expenditure === 'Expense') {
            $inputDTO = RegisterExpenseDTO::fromRequest($request);
            $expenseUsecase->handle($inputDTO);
        } else {
            $dataDTO=RegisterIncomeDTO::fromRequest($request);
            $incomeUsecase->handle($inputDTO);
        }

        return Inertia::render('Input/');
    }

    public function editExpense(Request $request, UpdateExpense $usecase)
    {
        $updateDTO = RegisterExpenseDTO::fromRequest($request);
        $usecase->handle($updateDTO);
        return Inertia::render('Edit/');
    }

    public function editIncome(Request $request, UpdateIncome $usecase)
    {
        $updateDTO = RegisterIncomeDTO::fromRequest($request);
        $usecase->handle($updateDTO);
        return Inertia::render('Edit/');
    }

    public function deleteExpense(Request $request, DeleteExpense $usecase)
    {
        $input = $request->all();
        $id = Arr::only($input, ['id'])['id'];
        return Inertia::render('delete/', ['data' => $usecase->handle($id)]);
    }

    public function deleteIncome(Request $request, DeleteIncome $usecase)
    {
        $input = $request->all();
        $id = Arr::only($input, ['id'])['id'];
        return Inertia::render('delete/', ['data'=>$usecase->handle($id)]);
    }

    public function getExpensePurpose(GetExpensePurpose $usecase)
    {
        return response()->json($usecase->handle());
    }

    public function getIncomePurpose(GetIncomePurpose $usecase)
    {
        return Inertia::render('Input/',['incomePurpose',$usecase->handle()]);
    }

    public function getExpenseCategory(GetExpenseCategory $usecase)
    {
        return Inertia::render('Input/', ['expenseCategory',$usecase->handle()]);
    }

    public function getIncomeCategory(GetIncomeCategory $usecase)
    {
        return Inertia::render('Input/', ['incomeCategory',$usecase->handle()]);
    }
}
