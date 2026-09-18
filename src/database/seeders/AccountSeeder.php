<?php

namespace Database\Seeders;

use App\Enum\AccountType;
use App\Models\Account;
use Decimal\Decimal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use phpDocumentor\Reflection\Types\Boolean;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Account::create([
            'name' => '銀行',
            'type' => AccountType::Bank,
            'balance' => 0,
            'is_active' => true,
        ]);

        Account::create([
            'name' => '財布',
            'type' => AccountType::Cash,
            'balance' => 0,
            'is_active' => true,
        ]);

        Account::create([
            'name' => '電子マネー',
            'type' => AccountType::EMoney,
            'balance' => 0,
            'is_active' => true,
        ]);

        Account::create([
            'name' => 'クレジットカード',
            'type' => AccountType::CreditCard,
            'balance' => 0,
            'is_active' => true,
        ]);
    }
}
