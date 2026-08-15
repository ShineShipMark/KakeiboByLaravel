<?php

namespace App\Data\Transaction;

use Spatie\LaravelData\Data;
use App\Enum\TransactionType;
use App\Enum\AccountType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Symfony\Contracts\Service\Attribute\Required;

#[TypeScript]
class TransactionSearchData extends Data
{
    public function __construct(
        #[Required]
        public ?string $keyword = null,
        public string $type = 'all',
        public ?int $categoryId = null,
        public ?string $startDate = null,
        public ?string $endDate = null,
        public string $account = 'cash',
        public int $page = 1,
        public int $perPage =15,
    )
    {}
}