<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputRequest;
use App\DTO\RegisterExpenseDTO;
use App\DTO\RegisterIncomeDTO;
use App\UseCases\RegisterExpense;
use App\UseCases\RegisterIncome;
use Illuminate\Http\Request;
use Inertia\Inertia;

class InputController extends Controller
{
    public function index()
    {
        return Inertia::render('Input');
    }

    public function store(InputRequest $request, RegisterExpense $expenseUsecase, RegisterIncome $incomeUsecase)
    {
        $expenditure = $request->input('expenditure', 'Expense');
        
        if ($expenditure === 'Expense') {
            $inputDTO = RegisterExpenseDTO::fromRequest($request);
            $expenseUsecase->handle($inputDTO);
        } else {
            $inputDTO=RegisterIncomeDTO::fromRequest($request);
            $incomeUsecase->handle($inputDTO);
        }

        return Inertia::render('Input/');
    }
}
