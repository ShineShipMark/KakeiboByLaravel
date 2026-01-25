<?php
use App\Models\IncomePurpose;

class GetIncomePurpose
{
    public function handle(): IncomePurpose
    {
        return IncomePurpose::find();
    }
}