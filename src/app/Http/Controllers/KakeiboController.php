<?php

namespace App\Http\Controllers;

use App\DTO\FindExpenseDTO;
use App\DTO\FindIncomeDTO;
use App\DTO\RegisterExpenseDTO;
use App\DTO\RegisterIncomeDTO;
use Illuminate\Http\Request;
use Inertia\Inertia;
use DeleteExpense;
use DeleteIncome;
use FindExpense;
use FindIncome;
use GetExpense;
use GetExpenseCategory;
use GetExpensePurpose;
use GetIncome;
use GetIncomeCategory;
use GetIncomePurpose;
use RegisterExpense;
use UpdateExpense;
use Illuminate\Support\Arr;
use RegisterIncome;
use UpdateIncome;

class KakeiboController extends Controller
{

    public function renderPage(Request $resuest)
    {
        $pageName = $resuest->segment(1);
        
        return Inertia::render($pageName,[]);
    }

    public function getExpense(GetExpense $usecase)
    {
        return Inertia::render('History/', ['data', $usecase->handle()]);
    }

    public function getIncome(GetIncome $usecase)
    {
        return Inertia::render('History/', ['data', $usecase->handle()]);;
    }

    public function findExpense(Request $request, FindExpense $usecase)
    {
        $dataDTO=FindExpenseDTO::fromRequest($request);
        return Inertia::render('History/',['data',$usecase->handle($dataDTO)]);
    }

    public function findIncome(Request $request, FindIncome $usecase)
    {
        $dataDTO=FindIncomeDTO::fromRequest($request);
        return Inertia::render('History/',['data',$usecase->handle($dataDTO)]);
    }

    public function inputExpense(Request $request, RegisterExpense $usecase)
    {
        $inputDTO = RegisterExpenseDTO::fromRequest($request);
        $usecase->handle($inputDTO);
        return Inertia::render('Input/');
    }

    public function inputIncome(Request $request, RegisterIncome $usecase)
    {
        $inputDTO = RegisterIncomeDTO::fromRequest($request);
        $usecase->handle($inputDTO);
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
        return Inertia::render('delete/', ['data', $usecase->handle($id)]);
    }

    public function deleteIncome(Request $request, DeleteIncome $usecase)
    {
        $input = $request->all();
        $id = Arr::only($input, ['id'])['id'];
        return Inertia::render('delete/', ['data', $usecase->handle($id)]);
    }

    public function getExpensePurpose(GetExpensePurpose $usecase)
    {
        return Inertia::render('Input/',['expensePurpose',$usecase->handle()]);
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
