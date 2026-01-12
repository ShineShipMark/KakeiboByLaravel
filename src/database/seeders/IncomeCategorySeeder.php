<?php

namespace Database\Seeders;

use App\Models\IncomeCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomeCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IncomeCategory::create([
            'id'=>1,
            'category'=>'給料'
        ]);

        IncomeCategory::create([
            'id'=>2,
            'category'=>'雑収入'
        ]);
    }
}
