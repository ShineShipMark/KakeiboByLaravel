<?php

use App\Http\Resources\ExpenseCategoryResourse;
use App\Models\ExpenseCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetExpenseCategory{
    public function handle():AnonymousResourceCollection
    {
        $category = ExpenseCategory::all();
        return ExpenseCategoryResourse::collection($category);
    }
}