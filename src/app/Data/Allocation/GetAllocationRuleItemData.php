<?php
namespace App\Data\Allocation;

use App\Data\Account\GetAccountData;
use App\Data\Category\CategoryResponseData;
use App\Enum\AllocationType;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class GetAllocationRuleItemData extends Data
{
    public function __construct(
        public ?int $id,
        public ?int $toAccountId,
        public ?GetAccountData $toAccount,
        public ?int $categoryId,
        public ?CategoryResponseData $category,
        #[Required]
        public AllocationType $type,
        public ?float $amount,
        public ?float $percentage,
        #[Min(1)]
        public int $priority = 1,
    )
    {
    }
}