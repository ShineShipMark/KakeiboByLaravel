<?php

use App\Models\Income;

class DeleteIncome
{
    public function handle(int $id): Income
    {
        Income::delete($id);

        return Income::find();
    }
}