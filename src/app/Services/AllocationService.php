<?php

use App\Models\AllocationRule;
use App\Models\AllocationRuleItem;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AllocationService
{
    public function executeAllocation(int $allocationRuleId, int $sourceAmount, Carbon $executeDate): Collection
    {
        return DB::transaction(function() use($allocationRuleId, $sourceAmount,$executeDate) {
            $rule = AllocationRule::with('items')->findOrFail($allocationRuleId);

            $rule->validateTotalPercentage();

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