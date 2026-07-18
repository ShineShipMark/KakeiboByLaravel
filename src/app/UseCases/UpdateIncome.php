<?php
namespace App\UseCases;
use App\DTO\UpdateIncomeDTO;
use App\Models\Income;
use Illuminate\Support\Facades\DB;

class UpdateIncome
{
    public function handle(UpdateIncomeDTO $data)
    {
        return DB::transaction(function () use($data) {
            $income = Income::findOrFail($data->id);
            $income->update($data->toArray());
        });
    }
}