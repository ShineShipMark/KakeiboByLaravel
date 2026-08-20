<?php

namespace App\Data\Allocation;

use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AllocationItemData extends Data
{
    public function __construct(
        #[Required]
        public int $categoryId,

        #[Required, Min(1)]
        public int $amount,
    ) {}
}