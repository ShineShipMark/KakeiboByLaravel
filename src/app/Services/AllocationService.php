<?php

namespace App\Services;

use App\Data\Allocation\AllocationItemData;
use App\Data\Transaction\TransactionData;
use App\Enum\TransactionType;
use App\Models\Allocation;
use App\Models\AllocationRule;
use App\Models\AllocationRuleItem;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AllocationService
{

    public function __construct(private TransactionService $transactionService)
    {
    }

    public function executeCustomAllocation(array $customAllocations, int $fromAccountId,int $parentTransactionId, Carbon $executeDate):Collection
    {
        return $this->saveAllocations($customAllocations, $fromAccountId, $parentTransactionId, $executeDate);
    }

    /**
     * 割り当てを実行
     * @param int $allocationRuleId 配分ルールのID
     * @param int $sourceAmount 元の金額(給料などの、各予算への配分前の金額)
     * @param Carbon $executeDate 配分の実行日
     * @return Collection 結果の一覧
     */
    public function executeRuleAllocation(int $allocationRuleId, int $sourceAmount, int $fromAccountId, int $parentTransactionId, Carbon $executeDate): Collection
    {
        // 配分ルールと内訳項目(家、スマホ料金など)を取得            
        $rule = AllocationRule::with('items')->findOrFail($allocationRuleId);
        $allocations = $rule->items->map(function(AllocationRuleItem $item) use ($sourceAmount){
            return new AllocationItemData(
                categoryId: $item->category_id,
                amount: $item->calculateAmount($sourceAmount),
                toAccountId: $item->to_account_id,
            );
        })->all();
        
        return $this->saveAllocations($allocations, $fromAccountId, $parentTransactionId, $executeDate);
    }

    private function saveAllocations(array $allocations, int $fromAccountId, int $parentTransactionId, Carbon $executeDate):Collection
    {
        $allocationsCollection = collect($allocations);
        return DB::transaction(function() use($allocationsCollection, $fromAccountId, $parentTransactionId, $executeDate) {
            return $allocationsCollection->filter(fn(AllocationItemData $item)=>$item->amount > 0)
            ->map(function(AllocationItemData $item) use ($fromAccountId, $parentTransactionId, $executeDate){
                $data = new TransactionData(
                    id:null,
                    type:TransactionType::Transfer,
                    amount:$item->amount,
                    date:$executeDate->toDateString(),
                    fromAccountId:$fromAccountId,
                    toAccountId:$item->toAccountId,
                    categoryId:$item->categoryId,
                    description:null,
                    parentTransactionId:$parentTransactionId,

                );
                return $this->transactionService->createTransaction($data);
            })->values();
        });
    }

    public function updateAllocations(array $allocations, int $fromAccountId, int $parentTransactionId, Carbon $executeDate):Collection
    {
        $this->deleteAllocations($parentTransactionId);

        return $this->saveAllocations($allocations, $fromAccountId, $parentTransactionId, $executeDate);
    }

    public function deleteAllocations(int $parentTransactionId):void
    {
        $parentTransaction = Transaction::findOrFail($parentTransactionId);

        $childAllocations = $parentTransaction->allocations;

        $childAllocations->each(function($item){
            $this->transactionService->deleteTransaction($item->id);
        });
    }

    public function getPreview(int $categoryId):Collection
    {
        return Allocation::where('category_id', $categoryId)
            ->with('category')
            ->get();
    }
}