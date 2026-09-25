<?php
namespace App\Data\Allocation;

use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class SaveAllocationRuleData extends Data
{
    public function __construct(
        public ?int $id,
        #[Required]
        public string $name,

        /** @var SaveAllocationRuleItemData[] */
        #[DataCollectionOf(SaveAllocationRuleItemData::class)]
        public array $items = [],
    )
    {
    }
}