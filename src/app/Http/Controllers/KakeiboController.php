<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Services\Contracts\KakeiboServiceInterface;
use DeleteExpense;
use DeleteIncome;
use GetExpense;
use GetIncome;
use RegisterExpense;
use UpdateExpense;
use Illuminate\Support\Arr;
use RegisterIncome;
use UpdateIncome;

class KakeiboController extends Controller
{

    public function renderPage(Request $resuest)
    {
        $pageName = $resuest->segments(1);
        return Inertia::render($pageName);
    }

    public function getExpense(GetExpense $usecase)
    {
        return Inertia::render('history/', ['data', $usecase->handle()]);;
    }

    public function getIncome(GetIncome $usecase)
    {
        return Inertia::render('history/', ['data', $usecase->handle()]);;
    }

    public function inputExpense(Request $request, RegisterExpense $usecase)
    {
        $input = $request->all();
        return Inertia::render('input/', ['data', $usecase->handle($input)]);
    }

    public function inputIncome(Request $request, RegisterIncome $usecase)
    {
        $input = $request->all();
        return Inertia::render('input/', ['data', $usecase->handle($input)]);
    }

    public function editExpense(Request $request, UpdateExpense $usecase)
    {
        $input = $request->all();
        $id = Arr::only($input, ['id'])['id'];
        $data = Arr::except($input,['id']);
        return Inertia::render('edit/', ['data', $usecase->handle($id, $data)]);
    }

    public function editIncome(Request $request, UpdateIncome $usecase)
    {
        $input = $request->all();
        $id = Arr::only($input, ['id'])['id'];
        $data = Arr::except($input,['id']);
        return Inertia::render('edit/', ['data', $usecase->handle($id, $data)]);
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
}
