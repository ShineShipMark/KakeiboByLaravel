<?php

namespace Database\Seeders;

use App\Models\IncomePurpose;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IncomePurposeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IncomePurpose::create([
            'id'=>1,
            'purpose'=>'月給',
            'income_category_id'=>1,
        ]);
    
        IncomePurpose::create([
            'id'=>2,
            'purpose'=>'ボーナス',
            'income_category_id'=>1,
        ]);

        IncomePurpose::create([
            'id'=>3,
            'purpose'=>'諸収入',
            'income_category_id'=>2,
        ]);

        IncomePurpose::create([
            'id'=>4,
            'purpose'=>'小遣い',
            'income_category_id'=>2,
        ]);
    }
}
