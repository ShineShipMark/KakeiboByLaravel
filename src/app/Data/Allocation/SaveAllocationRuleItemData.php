<?php
namespace App\Data\Allocation;

use App\Enum\AllocationType;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SaveAllocationRuleItemData extends Data
{
    public function __construct(
        public ?int $id,
        #[Required]
        public int $toAccountId,
        #[Required]
        public int $categoryId,
        #[Required]
        public AllocationType $type,
        public ?float $amount,
        public ?float $percentage,
        #[Min(1)]
        public int $priority = 1,
    )
    {
        throw new \Exception('Not implemented');
    }
}