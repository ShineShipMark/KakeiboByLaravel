<?php

namespace App\Http\Controllers;

use AllocationService;
use App\Data\Allocation\AllocationData;
use App\Data\Allocation\AllocationPreviewData;
use App\Data\Allocation\SaveAllocationRuleData;
use App\Services\AllocationRuleItemService;
use App\Services\AllocationRuleService;
use Inertia\Inertia;

class AllocationController extends Controller
{
    public function preview(AllocationPreviewData $data, AllocationService $service) 
    {

        $allocations = $service->getPreview($data->categoryId);
        
        return back()->with('allocations', AllocationData::collect($allocations));
    }

    public function store(SaveAllocationRuleData $data, AllocationRuleService $service)
    {
        $service->saveAllocationRule($data);

         return redirect()->route('allocationrule.input')->with('success', '登録完了');
    }

    public function getCategories(AllocationRuleItemService $service)
    {
        $categories = $service->getAllocationCategories();

        return Inertia::render('AllocationRule', [
            'categories' => $categories 
        ]);
    }
}
