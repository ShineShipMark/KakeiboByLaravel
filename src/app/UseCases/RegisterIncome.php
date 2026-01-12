<?php
use App\Models\Income;

class RegisterIncome
{
    public function handle(array $input): void{
        Income::create($input);
    }
}