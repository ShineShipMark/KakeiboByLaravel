<?php

use App\Models\Expense;

class UpdateExpense
{
    public function handle(int $id, array $input): Expense
    {
        Expense::where('id', $id)->save($input);

        return Expense::find();
    }
}