<?php

use App\Models\IncomeCategory;

class GetIncomeCategory{
    public function handle():IncomeCategory
    {
        return IncomeCategory::find();
    }
}