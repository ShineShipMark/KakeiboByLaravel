<?php
namespace App\UseCases;

use App\Services\AllocationService;
use App\Data\Transaction\TransactionData;
use App\Services\TransactionService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class StoreTransactionAction
{
    public function __construct(
        private  TransactionService $transactionService,
        private AllocationService $allocationService,
    )
    {
    }
    
    public function __invoke(TransactionData $data):void
    {
        DB::transaction(function () use ($data){
            $transaction = $this->transactionService->createTransaction($data);

            if (!empty($data->allocations)) {
                $executeDate = new Carbon($data->date);
                $this->allocationService->executeCustomAllocation($data->allocations, $data->toAccountId, $transaction->id, $executeDate);
            }
        });
    }
}