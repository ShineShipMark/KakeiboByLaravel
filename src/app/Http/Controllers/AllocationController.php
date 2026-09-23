<?php

namespace App\Http\Controllers;

use AllocationService;
use App\Data\Allocation\AllocationData;
use App\Data\Allocation\AllocationPreviewData;
use App\Data\Allocation\SaveAllocationRuleData;
use App\Services\AllocationRuleService;

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
}
