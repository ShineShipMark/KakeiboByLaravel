<?php

use App\DTO\FindIncomeDTO;
use App\Models\Income;

class FindIncome
{
    public function handle(FindIncomeDTO $data): Income
    {
        $foundData=Income::where('income_purpose_id','=',$data->income_purpose_id)
                            ->orWhere('amount','=',$data->amount)
                            ->orWhere('possession','=',$data->possession)
                            ->orWhere('detail','=',$data->detail)
                            ->whereBetwheen('at_date', [$data->first_date_time, $data->last_date_time])
                            ->get();

        return $foundData;
    }
}