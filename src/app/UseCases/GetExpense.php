<?php

use App\Http\Resources\ExpenseResource;
use App\Models\Expense;

class GetExpense
{
    public function handle():ExpenseResource
    {
        $expense = Expense::with(['expensesPurpose.expensesCategory'])->first();

        return new ExpenseResource($expense);
    }
}