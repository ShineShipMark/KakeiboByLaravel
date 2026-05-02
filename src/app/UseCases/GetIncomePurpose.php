<?php

use App\Http\Resources\IncomePurposeResource;
use App\Models\IncomePurpose;

class GetIncomePurpose
{
    public function handle(): IncomePurposeResource
    {
        $purpose= IncomePurpose::find();
        return new IncomePurposeResource($purpose);
    }
}