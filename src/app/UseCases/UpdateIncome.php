<?php

use App\Http\Resources\IncomeResource;
use App\Models\Income;

class UpdateIncome
{
    public function handle(int $id, array $input): IncomeResource
    {
        Income::where('id', $id)->save($input);

        return new IncomeResource(Income::find());
    }
}