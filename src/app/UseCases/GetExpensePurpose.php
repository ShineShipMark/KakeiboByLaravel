<?php

use App\Models\ExpensePurpose;

class GetExpensePurpose
{
    public function handle(): ExpensePurpose
    {
        return ExpensePurpose::find();
    }
}