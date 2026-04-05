<?php

use App\DTO\FindExpenseDTO;
use App\Models\Expense;

class FindExpense
{
    public function handle(FindExpenseDTO $data): Expense
    {
        $foundData=Expense::where('expense_purpose_id','=',$data->expense_purpose_id)
                            ->orWhere('amount','=',$data->amount)
                            ->orWhere('possession','=',$data->possession)
                            ->orWhere('detail','=',$data->detail)
                            ->whereBetwheen('at_date', [$data->first_date_time, $data->last_date_time])
                            ->get();

        return $foundData;
    }
}