<?php
namespace App\UseCases;

use App\Services\AllocationService;
use App\Data\Transaction\TransactionData;
use App\Services\TransactionService;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateTransactionAction
{
    public function __construct(
        private TransactionService $transactionService, 
        private AllocationService $allocationService,
    )
    {
    }

    public function __invoke(int $id,TransactionData $data):void
    {
        DB::transaction(function () use ($id, $data){
            $this->transactionService->updateTransaction($id,$data);

            $convertedDate = new Carbon($data->date);
            $this->allocationService->updateAllocations($data->allocations ?? [], $data->toAccountId, $id,  $convertedDate);
        });
    }
}