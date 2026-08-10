<?php

namespace App\Data\Transaction;

use App\Enum\TransactionType;
use App\Models\Transaction;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;

class TransactionData extends Data
{
    public function __construct(
        public ?int $id,
        #[Required]
        public TransactionType $type,

        #[Required, Min(1)]
        public int $amount,

        #[Required]
        public string $date,

        public ?int $fromAccountId,
        public ?int $toAccountId,
        public ?int $categoryId,
        public ?string $description,
    ){}

    public static function fromModel(Transaction $transaction): self
    {
        return new self(
            id: $transaction->id,
            type: $transaction->type,
            amount:$transaction->amount,
            date:$transaction->date,
            fromAccountId:$transaction->from_account_id,
            toAccountId:$transaction->to_account_id,
            categoryId:$transaction->category_id,
            description:$transaction->description,
        );
    }
}