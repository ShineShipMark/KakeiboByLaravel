<?php
namespace App\Services;

use App\Data\Account\GetAccountData;
use App\Data\Allocation\AllocationsCategoriesData;
use App\Data\Allocation\GetAllocationRuleItemData;
use App\Data\Category\CategoryResponseData;
use App\Models\Account;
use App\Models\AllocationRuleItem;
use App\Models\Category;
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

    public function getAllocationCategories():AllocationsCategoriesData
    {
        $categories =CategoryResponseData::collect(Category::orderBy('sort_order')->get());
        $accounts = GetAccountData::collect(Account::all());

        return new AllocationsCategoriesData(categories:$categories->all(), accounts:$accounts->all());
    }
}