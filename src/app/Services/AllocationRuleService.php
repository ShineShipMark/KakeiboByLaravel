<?php
namespace App\Services;

use App\Data\Allocation\SaveAllocationRuleData;
use App\Data\Allocation\SaveAllocationRuleItemData;
use App\Models\AllocationRule;
use App\Models\AllocationRuleItem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AllocationRuleService
{
    public function createAllocationRuleItem(int $allocationRuleId, SaveAllocationRuleItemData $data):SaveAllocationRuleItemData
    {
        return DB::transaction(function () use ($allocationRuleId, $data){
            $allocationRuleItem = AllocationRuleItem::create([
                'allocation_rule_id'=> $allocationRuleId,
                'to_account_id'=> $data->toAccountId,
                'category_id' => $data->categoryId, // タイポ修正
                'type' => $data->type,
                'amount' => $data->amount,
                'percentage' => $data->percentage,
                'priority' => $data->priority,
            ]);

            return SaveAllocationRuleItemData::from($allocationRuleItem);
        });
    }

    public function saveAllocationRule(SaveAllocationRuleData $data): SaveAllocationRuleData
    {
        return DB::transaction(function () use ($data){
            $rule = AllocationRule::updateOrCreate(
                ['id' => $data->id],
                ['name' => $data->name],
            );

            $rule->items()->delete();

            foreach ($data->items as $itemData) {
                $this->createAllocationRuleItem($rule->id, $itemData);
            }

            return SaveAllocationRuleData::from($rule->load('items'));
        });
    }
}