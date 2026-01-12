<?php

namespace Database\Seeders;

use App\Models\ExpenseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpenseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExpenseCategory::create([
            'id'=>1,
            'category'=>'食費'
        ]);

        ExpenseCategory::create([
            'id'=>2,
            'category'=>'雑費'
        ]);

        ExpenseCategory::create([
            'id'=>3,
            'category'=>'遊興費'
        ]);

        ExpenseCategory::create([
            'id'=>4,
            'category'=>'病気関係'
        ]);
    }
}
