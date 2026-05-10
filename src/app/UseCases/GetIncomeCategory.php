<?php

use App\Http\Resources\IncomeCategoryResourse;
use App\Models\IncomeCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetIncomeCategory{
    public function handle():AnonymousResourceCollection
    {
        $category= IncomeCategory::all();
        return IncomeCategoryResourse::collection($category);
    }
}