<?php
namespace App\UseCases;
use App\Http\Resources\ExpenseCategoryResource;
use App\Models\ExpenseCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetExpenseCategory{
    public function handle():AnonymousResourceCollection
    {
        $category = ExpenseCategory::all();
        return ExpenseCategoryResource::collection($category);
    }
}