<?php

use App\Http\Resources\IncomeCategoryResourse;
use App\Models\IncomeCategory;

class GetIncomeCategory{
    public function handle():IncomeCategoryResourse
    {
        $category= IncomeCategory::find();
        return new IncomeCategoryResourse($category);
    }
}