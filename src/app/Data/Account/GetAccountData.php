<?php

namespace App\Data\Account;

use App\Enum\AccountType;
use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class GetAccountData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public AccountType $type,
        public float $balance,
        public bool $is_active
    )
    {
    }

}