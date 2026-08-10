<?php

namespace App\Services;

use App\Models\Account;

class AccountBalanceService
{
    /**
     * 指定された口座における『実残高』『貯金目標に割り当て済みの金額』『未割当の自由に使える金額』を計算してサマリーとして返す
     * @param int $accountId 口座ID
     * @return array サマリーデータ
     */
    public function getAccountSummary(int $accountId): array
    {
        // 口座関連のデータを一括取得
        $account = Account::with(['savingGoals', 'fromTransactions', 'toTransactions'])->findOrFail($accountId);

        // 口座と財布の残高を計算
        $actualBalance = $account->calculateActualBalance();

        // 貯金目標内のロックされている金額の集計(貯金として確定している金額)
        $allocatedToGoals = $account->savingGoals->sum('current_amount');

        // 口座の中で自由に使える金額を計算
        $unallocatedBalance = $account->calculateUnallocatedBalance();

        // 連想配列でそれぞれの値を返す
        return [
            'account_id' => $account->id,
            'account_name' => $account->name,
            'actual_balance' => $actualBalance,
            'allocated_to_goals' => $allocatedToGoals,
            'unallocated_balance' => $unallocatedBalance,   
        ];
    }
}