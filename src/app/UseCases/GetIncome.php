<?php

use App\Http\Resources\IncomeResource;
use App\Models\Income;

class GetIncome
{
    public function handle():IncomeResource
    {
        $income = Income::with(['incomesPurpose.incomesCategory'])->first();

        return new IncomeResource($income);
    }
}