<?php

namespace App\Http\Controllers;

use AllocationService;
use App\Data\Allocation\AllocationData;
use App\Data\Allocation\AllocationPreviewData;

class AllocationController extends Controller
{
    public function preview(AllocationPreviewData $data, AllocationService $service) 
    {

        $allocations = $service->getPreview($data->categoryId);
        
        return back()->with('allocations', AllocationData::collect($allocations));
    }
}
