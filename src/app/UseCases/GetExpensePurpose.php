<?php

use App\Http\Resources\ExpensePurposeResourse;
use App\Models\ExpensePurpose;

class GetExpensePurpose
{
    public function handle(): ExpensePurposeResourse
    {
        $purpose = ExpensePurpose::find();
        return new ExpensePurposeResourse($purpose);
    }
}