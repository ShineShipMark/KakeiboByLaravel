<?php

use App\Models\Income;

class GetIncome
{
    public function handle():Income
    {
        return Income::find();
    }
}