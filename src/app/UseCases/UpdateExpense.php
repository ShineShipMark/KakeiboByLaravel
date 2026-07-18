<?php
namespace App\UseCases;
use App\DTO\UpdateExpenseDTO;
use App\Models\Expense;
use Illuminate\Support\Facades\DB;

class UpdateExpense
{
    public function handle(UpdateExpenseDTO $data)
    {
        return DB::transaction(function () use($data) {
            $expense = Expense::findOrFail($data->id);
            $expense->update($data->toArray());
        });
    }
}