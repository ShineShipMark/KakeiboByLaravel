<?php
namespace App\Data\Transaction;

use App\Data\Account\GetAccountData;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\LaravelData\Attributes\DataCollectionOf;
use Spatie\TypeScriptTransformer\Attributes\LiteralTypeScriptType;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class TransactionIndexData extends Data
{
    public function __construct(
        #[DataCollectionOf(TransactionData::class)]
        #[LiteralTypeScriptType('Paginated<App.Data.Transaction.TransactionData>')]
        public PaginatedDataCollection $transactions,
        public TransactionFilterData $filters,
        #[DataCollectionOf(GetAccountData::class)]
        /** @var GetAccountData[] */
        public array $accounts = [],
    )
    {
    }
}