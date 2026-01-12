<?php

namespace Database\Seeders;

use App\Models\ExpensePurpose;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExpensePurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ExpensePurpose::create([
            'id'=>1,
            'purpose'=>'家への支払い',
            'expense_category_id'=>1
        ]);

        ExpensePurpose::create([
            'id'=>2,
            'purpose'=>'外食',
            'expense_category_id'=>1
        ]);

        ExpensePurpose::create([
            'id'=>3,
            'purpose'=>'書籍',
            'expense_category_id'=>2
        ]);

        ExpensePurpose::create([
            'id'=>4,
            'purpose'=>'文房具',
            'expense_category_id'=>2
        ]);

        ExpensePurpose::create([
            'id'=>5,
            'purpose'=>'雑貨',
            'expense_category_id'=>2
        ]);

        ExpensePurpose::create([
            'id'=>6,
            'purpose'=>'家具',
            'expense_category_id'=>2
        ]);

        ExpensePurpose::create([
            'id'=>7,
            'purpose'=>'車関係、燃料',
            'expense_category_id'=>2
        ]);

        ExpensePurpose::create([
            'id'=>8,
            'purpose'=>'税金など',
            'expense_category_id'=>2
        ]);

        ExpensePurpose::create([
            'id'=>9,
            'purpose'=>'その他',
            'expense_category_id'=>2
        ]);

        ExpensePurpose::create([
            'id'=>10,
            'purpose'=>'釣り',
            'expense_category_id'=>3
        ]);

        ExpensePurpose::create([
            'id'=>11,
            'purpose'=>'プラモ',
            'expense_category_id'=>3
        ]);

        ExpensePurpose::create([
            'id'=>12,
            'purpose'=>'ゲーム',
            'expense_category_id'=>3
        ]);

        ExpensePurpose::create([
            'id'=>13,
            'purpose'=>'趣味の書籍など',
            'expense_category_id'=>3
        ]);

        ExpensePurpose::create([
            'id'=>14,
            'purpose'=>'通院費',
            'expense_category_id'=>4
        ]);

        ExpensePurpose::create([
            'id'=>15,
            'purpose'=>'薬、マスク等',
            'expense_category_id'=>4
        ]);
    }
}
