<?php
namespace App\UseCases;
use App\Http\Resources\IncomeCategoryResource;
use App\Models\IncomeCategory;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetIncomeCategory{
    public function handle():AnonymousResourceCollection
    {
        $category= IncomeCategory::all();
        return IncomeCategoryResource::collection($category);
    }
}