<?php

namespace App\Http\Controllers;

use App\UseCases\GetExpenseCategory;
use App\UseCases\GetExpensePurpose;
use App\UseCases\GetIncomeCategory;
use App\UseCases\GetIncomePurpose;
use Illuminate\Http\Request;

class MasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, GetExpensePurpose $getExpensePurpose, GetExpenseCategory $getExpenseCategory,
     GetIncomePurpose $getIncomePurpose, GetIncomeCategory $getIncomeCategory)
    {
       
        $expensePurpose = $getExpensePurpose->handle();
        $expenseCategory = $getExpenseCategory->handle();
        $incomePurpose = $getIncomePurpose->handle();
        $incomeCategory = $getIncomeCategory->handle();

        return response()->json([
            'expense'=>[
                'purpose' => $expensePurpose,
                'category' => $expenseCategory
            ],
            'income' => [
                'purpose' => $incomePurpose,
                'category' => $incomeCategory
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
