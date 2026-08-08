<?php

namespace App\Services;

use App\Models\Account;

class AccountBalanceService
{
    public function getAccountSummary(int $accountId): array
    {
        $account = Account::with(['savingGoals', 'fromTransactions', 'toTransactions'])->findOrFail($accountId);

        $actualBalance = $account->calculateActualBalance();

        $allocatedToGoals = $account->savingGoals->sum('current_amount');

        $unallocatedBalance = $account->calculateUnallocatedBalance();

        return [
            'account_id' => $account->id,
            'account_name' => $account->name,
            'actual_balance' => $actualBalance,
            'allocated_to_goals' => $allocatedToGoals,
            'unallocated_balance' => $unallocatedBalance,   
        ];
    }
}