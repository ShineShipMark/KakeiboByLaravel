<?php

use App\Http\Resources\ExpenseResource;
use App\Models\Expense;

class UpdateExpense
{
    public function handle(int $id, array $input): ExpenseResource
    {
        Expense::where('id', $id)->save($input);

        return new ExpenseResource(Expense::find());
    }
}