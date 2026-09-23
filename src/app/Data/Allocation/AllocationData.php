<?php

namespace App\Data\Allocation;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AllocationData extends Data
{
    public function __construct(
        public int $id,
        public int $transactionId,
        public int $categoryId,
        public int $amount,
        public ?string $memo = null,
    ){}
}