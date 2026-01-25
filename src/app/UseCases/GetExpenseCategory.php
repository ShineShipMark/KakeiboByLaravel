<?php

use App\Models\ExpenseCategory;

class GetExpenseCategory{
    public function handle():ExpenseCategory
    {
        return ExpenseCategory::find();
    }
}