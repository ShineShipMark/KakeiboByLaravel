<?php

namespace Database\Seeders;

use App\Data\Transaction\TransactionData;
use App\Enum\TransactionType;
use App\Models\Account;
use App\Models\Category;
use App\Services\TransactionService;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(TransactionService $service): void
    {
        $account = Account::first();
        $fishingCategory = Category::where('name', '釣り')->first();
        $salaryCategory = Category::where('name', '基本給')->first();

        if($account && $fishingCategory) {
            $fishingData = new TransactionData(
                    id:null,
                    type:TransactionType::Expense,
                    amount:30000,
                    date:'2026-08-02',
                    fromAccountId:$account->id,
                    toAccountId:null,
                    categoryId:$fishingCategory->id,
                    description:null,
                    parentTransactionId:null,
            );

            $service->createTransaction($fishingData);
        }

        if($account && $salaryCategory) {
            $salaryData = new TransactionData(
                id:null,
                type:TransactionType::Income,
                amount:300000,
                date:'2026-08-01',
                fromAccountId:null,
                toAccountId:$account->id,
                categoryId:$salaryCategory->id,
                description:null,
                parentTransactionId:null,
            );

            $service->createTransaction($salaryData);
        }
    }
}
