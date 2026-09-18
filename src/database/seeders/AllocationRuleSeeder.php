<?php

namespace Database\Seeders;

use App\Models\AllocationRule;
use App\Models\AllocationRuleItem;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllocationRuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AllocationRule::create([
            'name' => '毎月のルール',
            'is_active' => true,
        ]);

     
    }
}
