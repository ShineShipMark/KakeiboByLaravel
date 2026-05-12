<?php

use App\DTO\RegisterExpenseDTO;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class UpdateExpense
{
    public function handle(RegisterExpenseDTO $data)
    {
        return DB::transaction(function () use($data) {
            $expense = Expense::findOrFail($data->id);
            unset($data['id']);
            $expense->update($data->toArray());
        });
    }
}