<?php

use App\Data\Allocation\AllocationItemData;
use App\Models\AllocationRule;
use App\Models\AllocationRuleItem;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AllocationService
{

    public function executeCustomAllocation(array $customAllocations, int $fromAccountId, Carbon $executeDate):Collection
    {
        return $this->saveAllocations(collect($customAllocations), $fromAccountId, $executeDate);
    }

    /**
     * 割り当てを実行
     * @param int $allocationRuleId 配分ルールのID
     * @param int $sourceAmount 元の金額(給料などの、各予算への配分前の金額)
     * @param Carbon $executeDate 配分の実行日
     * @return Collection 結果の一覧
     */
    public function executeRuleAllocation(int $allocationRuleId, int $sourceAmount, int $fromAccountId, Carbon $executeDate): Collection
    {
        // 配分ルールと内訳項目(家、スマホ料金など)を取得            
        $rule = AllocationRule::with('items')->findOrFail($allocationRuleId);
        $allocations = $rule->items->map(function(AllocationRuleItem $item) use ($sourceAmount){
            return [
                'category_id' => $item->category_id,
                'amount' => $item->calculateAmount($sourceAmount),
                'to_account_id' => $item->to_account_id,
            ];
        });
        
        return $this->saveAllocations($allocations, $fromAccountId, $executeDate);
    }

    private function saveAllocations(Collection $allocations, int $fromAccountId, Carbon $executeDate):Collection
    {
        return DB::transaction(function() use($allocations, $fromAccountId, $executeDate) {
            // Transactionインスタンスを生成し、null項目を除外、個別の取引ルールをチェックして、取引をDBへ保存する
            return $allocations->map(function (AllocationItemData $item) use ($fromAccountId, $executeDate){
                $transaction = new Transaction([
                    'from_account_id' => $fromAccountId,
                    'to_account_id' => $item->toAccountId,
                    'category_id' => $item->categoryId,
                    'amount' => $item->amount,
                    'date' => $executeDate,
                    'type' => 'transfer',
                ]);
                $transaction->validateInvariants();
                $transaction->save();
                return $transaction;
            });
        });
    }

    public function updateAllocations(int $parentTransactionId, array $allocations, int $fromAccountId, Carbon $date):Collection
    {
        return DB::transaction(function () use ($parentTransactionId, $allocations, $fromAccountId, $date){
            Transaction::where('parent_transaction_id', $parentTransactionId)->delete();

            return collect($allocations)->map(function (AllocationItemData $item) use ($parentTransactionId, $fromAccountId, $date){
                $transaction = new Transaction([
                    'parent_transaction_id' => $parentTransactionId,
                    'from_account_id' => $fromAccountId,
                    'to_account_id' => $item->toAccountId,
                    'category_id' => $item->categoryId,
                    'amount' => $item->amount,
                    'date' => $item->$date,
                    'type' => 'transfer',
                ]);

                $transaction->validateInvariants();
                $transaction->save();

                return $transaction;
            });
        });
    }
}