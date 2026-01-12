<?php
use App\Models\Expense;

class RegisterExpense
{
    public function handle(array $input): void{
        Expense::create($input);
    }
}