<?php

use App\Http\Resources\ExpensePurposeResourse;
use App\Models\ExpensePurpose;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetExpensePurpose
{
    public function handle(): AnonymousResourceCollection
    {
        $purpose = ExpensePurpose::all();
        return ExpensePurposeResourse::collection($purpose);
    }
}