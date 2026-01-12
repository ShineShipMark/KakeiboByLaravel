<?php

use App\Models\Expense;

class GetExpense
{
    public function handle():Expense
    {
        return Expense::find();
    }
}