<?php

use App\Models\Income;

class UpdateIncome
{
    public function handle(int $id, array $input): Income
    {
        Income::where('id', $id)->save($input);

        return Income::find();
    }
}