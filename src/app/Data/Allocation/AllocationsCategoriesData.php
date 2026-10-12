<?php

namespace App\Data\Allocation;

use App\Data\Category\CategoryResponseData;
use App\Data\Account\GetAccountData;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AllocationsCategoriesData extends Data
{
    /**
     * @param array<CategoryResponseData> $categories
     * @param array<GetAccountData> $accounts
     */
    public function __construct(
        public array $categories,
        public array $accounts
    )
    {
    }
}