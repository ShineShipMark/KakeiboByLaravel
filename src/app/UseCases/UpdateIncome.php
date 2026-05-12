<?php

use App\DTO\RegisterIncomeDTO;
use App\Models\Income;
use Illuminate\Support\Facades\DB;

class UpdateIncome
{
    public function handle(RegisterIncomeDTO $data)
    {
        return DB::transaction(function () use($data) {
            $income = Income::findOrFail($data->id);
            unset($data['id']);
            $income->update($data->toArray());
        });
    }
}