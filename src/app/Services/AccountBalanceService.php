<?php

namespace App\Services;

use App\Data\Account\AccountBalanceSummaryData;
use App\Models\Account;
use Illuminate\Support\Collection;

class AccountBalanceService
{
    /**
     * 指定された口座における『実残高』『貯金目標に割り当て済みの金額』『未割当の自由に使える金額』を計算してサマリーとして返す
     * @param int $accountId 口座ID
     * @return AccountBalanceSummaryData サマリーデータ
     */
    public function getAccountSummary(int $accountId): AccountBalanceSummaryData
    {
        // 口座関連のデータを一括取得
        $account = Account::with(['savingGoals', 'fromTransactions', 'toTransactions'])->findOrFail($accountId);

        return new AccountBalanceSummaryData(
            accountId:$account->id,
            accountName:$account->name,
            actualBalance:$account->calculateActualBalance(),
            allocatedBalance:$account->savingGoals->sum('current_amount'),
            unallocatedBalance:$account->calculateUnallocatedBalance(),
        );
    }

    public function getMultipleAccountSummries(array $accountIds): Collection
    {
        return collect($accountIds)
            ->map(fn(int $id) => $this->getAccountSummary($id))
            ->keyBy('accountId');
    }
}