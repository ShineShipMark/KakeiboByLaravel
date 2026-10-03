<?php 

namespace App\Services;

use App\Data\Account\GetAccountData;
use App\Models\Account;

class AccountService
{
    public function getAccount(int $accountId):GetAccountData
    {
        return Account::where('id', $accountId)->get();
    }
}