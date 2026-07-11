<?php
namespace App\UseCases;
use App\Http\Resources\IncomePurposeResource;
use App\Models\IncomePurpose;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class GetIncomePurpose
{
    public function handle(): AnonymousResourceCollection
    {
        $purpose= IncomePurpose::all();
        return IncomePurposeResource::collection($purpose);
    }
}