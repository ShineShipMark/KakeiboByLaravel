<?php 

namespace App\Services;

use App\Data\Account\GetAccountData;
use App\Models\Account;
use Illuminate\Support\Collection;

class AccountService
{
    public function getAccount(int $accountId):Collection
    {
        return Account::where('id', $accountId)->get();
    }
}