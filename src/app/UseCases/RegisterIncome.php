<?php

use App\DTO\RegisterIncomeDTO;
use App\Models\Income;
use Illuminate\Support\Facades\DB;

class RegisterIncome
{
    public function handle(RegisterIncomeDTO $data)
    {
        return DB::transaction(function () use($data) {
            $income=Income::create($data);
        });
    }
}