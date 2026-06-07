<?php
namespace App\UseCases;
use App\Http\Resources\ExpensePurposeResource;
use App\Models\ExpensePurpose;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetExpensePurpose
{
    public function handle(): AnonymousResourceCollection
    {
        $purpose = ExpensePurpose::all();
        return ExpensePurposeResource::collection($purpose);
    }
}