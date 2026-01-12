<?php

use App\Models\Expense;

class DeleteExpense
{
    public function handle(int $id): Expense
    {
        Expense::delete($id);

        return Expense::find();
    }
}