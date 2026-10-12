<?php

namespace Database\Seeders;

use App\Enum\AllocationType;
use App\Models\Account;
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
        $account = Account::where('name', '財布')->first();

        if ($hobbyCategory) {
            AllocationRuleItem::create([
                'allocation_rule_id' => $rule->id,
                'to_account_id' => $account->id,
                'category_id' => $hobbyCategory->id,
                'type' => AllocationType::Fixed,
                'amount' => 30000,
                'percentage' => 0,
                'priority' => 1
            ]);
        }

        if ($sundryCategory) {
            AllocationRuleItem::create([
                'allocation_rule_id' => $rule->id,
                'to_account_id' => $account->id,
                'category_id' => $sundryCategory->id,
                'type' => AllocationType::Fixed,
                'amount' => 30000,
                'percentage' => 0,
                'priority' => 2
            ]);
        }
    }
}
