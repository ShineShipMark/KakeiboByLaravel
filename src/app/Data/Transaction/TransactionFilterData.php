<?php

namespace App\Data\Transaction;

use Spatie\LaravelData\Data;
use App\Enum\TransactionType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;


#[TypeScript]
class TransactionFilterData extends Data
{
    public function __construct(
        public ?string $keyword = null,
        public TransactionType $type = TransactionType::All,
        public ?int $categoryId = null,
        public ?string $startDate = null,
        public ?string $endDate = null,
        public ?int $accountId = null,
        public int $page = 1,
        public int $perPage =15,
    ){}
}