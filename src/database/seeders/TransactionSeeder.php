<?php

namespace Database\Seeders;

use App\Enum\TransactionType;
use App\Models\Account;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $account = Account::first();
        $fishingCategory = Category::where('name', '釣り')->first();
        $salaryCategory = Category::where('name', '基本給')->first();

        if($account && $fishingCategory) {
            Transaction::create([
                'type' => TransactionType::Expense->value,
                'from_account_id' => $account->id,
                'to_account_id' => null,
                'category_id' => $fishingCategory->id,
                'amount' => 3000,
                'date' => '2026-08-08',
                'description' => 'テスト'
            ]);
        }

        if($account && $salaryCategory) {
            Transaction::create([
                'type' => TransactionType::Income->value,
                'from_account_id' => $account->id,
                'to_account_id' => null,
                'category_id' => $salaryCategory->id,
                'amount' => 240000,
                'date' => '2026-08-25',
                'description' => 'テスト'
            ]);
        }
    }
}
