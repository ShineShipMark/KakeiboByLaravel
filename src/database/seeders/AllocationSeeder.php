<?php

namespace Database\Seeders;

use App\Models\Allocation;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $hobbyCategory = Category::where('name', '趣味')->first();
        $transaction = Transaction::first();

        if ($hobbyCategory) {
            Allocation::create([
                'transaction_id' => $transaction->id,
                'category_id' => $hobbyCategory->id,
                'year_month' => '2026-08',
                'amount' => 30000,
                'memo' => '趣味予算配分'
            ]);
        }
    }
}
