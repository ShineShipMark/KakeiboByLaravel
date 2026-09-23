<?php

namespace App\Data\Allocation;

use Carbon\Carbon;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\DateTimeInterfaceCast;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType; 

#[TypeScript]
class ExecuteAllocationData extends Data
{
    public function __construct(
        public int $allocationRuleId,
        public int $sourceAmount,

        #[WithCast(DateTimeInterfaceCast::class, format: 'Y-m-d')]
        #[TypeScriptType('string')]
        public Carbon $executeDate,

        // 手入力の調整値配列（必要な場合）
        #[DataCollectionOf(AllocationItemData::class)]
        /** @var AllocationItemData[]|null */
        public ?array $allocations = null,
    ){}
}