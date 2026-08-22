<?php

namespace App\Data\Transaction;

use Spatie\LaravelData\Data;
use App\Enum\TransactionType;
use App\Enum\AccountType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Symfony\Contracts\Service\Attribute\Required;

#[TypeScript]
class TransactionFilterData extends Data
{
    public function __construct(
        #[Required]
        public ?string $keyword = null,
        public TransactionType $type = TransactionType::All,
        public ?int $categoryId = null,
        public ?string $startDate = null,
        public ?string $endDate = null,
        public int $accountId = 1,
        public int $page = 1,
        public int $perPage =15,
    ){}
}