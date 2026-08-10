<?php

namespace App\Data\Account;

use App\Models\Account;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AccountBalanceSummaryData extends Data
{
    public function __construct(
        public int $accountId,
        public string $accountName,
        public int $actualBalance,
        public int $allocatedBalance,
        public int $unallocatedBalance,
    ){}

    public static function fromAccount(Account $account): self
    {
        $actual = $account->calculateActualBalance();
        $allocated = (int) $account->savingGoals()->sum('current_amount');

        return new self(
            accountId:$account->id,
            accountName:$account->name,
            actualBalance:$actual,
            allocatedBalance:$allocated,
            unallocatedBalance:$actual - $allocated,
        );
    }

}