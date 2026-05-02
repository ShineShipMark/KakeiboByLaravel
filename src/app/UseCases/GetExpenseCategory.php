<?php

use App\Http\Resources\ExpenseCategoryResourse;
use App\Models\ExpenseCategory;

class GetExpenseCategory{
    public function handle():ExpenseCategoryResourse
    {
        $category =ExpenseCategory::find();
        return new ExpenseCategoryResourse($category);
    }
}