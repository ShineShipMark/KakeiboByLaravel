<?php
namespace App\Services;

use App\Data\Allocation\GetAllocationRuleItemData;
use App\Models\AllocationRuleItem;
use Illuminate\Support\Collection;

class AllocationRuleItemService
{
    public function getAllocationRuleItem(int $allocationRuleId):GetAllocationRuleItemData
    {
        $allocationRuleItem = AllocationRuleItem::with(['toAccount', 'category'])
            ->where('allocation_rule_id', $allocationRuleId)
            ->firstOrFail();

        return GetAllocationRuleItemData::from($allocationRuleItem);
    }
}