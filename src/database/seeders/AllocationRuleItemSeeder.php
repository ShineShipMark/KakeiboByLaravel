<?php

namespace Database\Seeders;

use App\Models\AllocationRule;
use App\Models\AllocationRuleItem;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AllocationRuleItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $rule = AllocationRule::first();
        $hobbyCategory = Category::where('name', '趣味')->first();
        $sundryCategory = Category::where('name', '雑費')->first();

        if ($hobbyCategory) {
            AllocationRuleItem::create([
                'allocation_rule_id' => $rule->id,
                'category_id' => $hobbyCategory->id,
                'amount' => 30000,
            ]);
        }

        if ($sundryCategory) {
            AllocationRuleItem::create([
                'allocation_rule_id' => $rule->id,
                'category_id' => $sundryCategory->id,
                'amount' => 30000,
            ]);
        }
    }
}
