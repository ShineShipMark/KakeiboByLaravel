<?php

use App\Models\AllocationRule;
use App\Models\AllocationRuleItem;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AllocationService
{
    /**
     * 割り当てを実行
     * @param int $allocationRuleId 配分ルールのID
     * @param int $sourceAmount 元の金額(給料などの、各予算への配分前の金額)
     * @param Carbon $executeDate 配分の実行日
     * @return Collection 結果の一覧
     */
    public function executeAllocation(int $allocationRuleId, int $sourceAmount, Carbon $executeDate): Collection
    {
        // トランザクション
        return DB::transaction(function() use($allocationRuleId, $sourceAmount,$executeDate) {
            // 配分ルールと内訳項目(家、スマホ料金など)を取得            
            $rule = AllocationRule::with('items')->findOrFail($allocationRuleId);

            // バリデーション
            $rule->validateTotalPercentage();

            // Transactionインスタンスを生成し、null項目を除外、個別の取引ルールをチェックして、取引をDBへ保存する
            return $rule->items
                ->map(fn(AllocationRuleItem $item) => $item->createTransaction($rule->from_account_id, $sourceAmount, $executeDate))
                ->filter()
                ->map(function (Transaction $transaction) {
                    $transaction->validateInvariants();
                    $transaction->save();

                    return $transaction;
                });
        });
    }
}