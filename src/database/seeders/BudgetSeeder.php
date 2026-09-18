<?php

namespace Database\Seeders;

use App\Models\Budget;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BudgetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $yearMonth = '2026-08';

        $hobbyCategory = Category::where('name', '趣味')->first();
        $sundryCategory = Category::where('name', '雑費')->first();

        if($hobbyCategory) {
            Budget::create([
                'category_id' => $hobbyCategory->id,
                'year_month' => $yearMonth,
                'amount' => 30000,
                'carryover_amount' => 0,
                'is_closed' => false,
            ]);
        }

        if ($sundryCategory) {
            Budget::create([
                'category_id' => $sundryCategory->id,
                'year_month' => $yearMonth,
                'amount' => 30000,
                'carryover_amount' => 0,
                'is_closed' => false,
            ]);
        }
    }
}
