<?php

use App\Http\Resources\ExpenseResource;
use App\Models\Expense;

class DeleteExpense
{
    public function handle(int $id): ExpenseResource
    {
        Expense::destroy($id);

        return new ExpenseResource(Expense::find());
    }
}