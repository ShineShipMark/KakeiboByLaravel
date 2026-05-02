<?php

use App\Http\Resources\IncomeResource;
use App\Models\Income;

class DeleteIncome
{
    public function handle(int $id): IncomeResource
    {
        Income::destroy($id);

        return new IncomeResource(Income::find());
    }
}