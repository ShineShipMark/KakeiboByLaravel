<?php

namespace App\Http\Controllers;

use App\Models\Allocation;
use Illuminate\Http\Request;

class AllocationController extends Controller
{
    public function preview(Request $request) 
    {
        $validate = $request->validate([
            'category_id' => ['required', 'exits:categories,id'],
        ]);

        $allocations = Allocation::where('category_id', $validate['category_id'])
            ->with('category')
            ->get();
        
        return back()->with('allocations', $allocations);
    }
}
