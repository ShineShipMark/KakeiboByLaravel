<?php
namespace App\UseCases;

use AllocationService;
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
        throw new \Exception('Not implemented');
    }

    public function __invoke(int $id,TransactionData $data):void
    {
        DB::transaction(function () use ($id, $data){
            $this->transactionService->updateTransaction($id,$data);

            if (!(empty($data->allocations))) {
                $convertedDate = new Carbon($data->date);
                $this->allocationService->updateAllocations($id, $data->allocations, $data->fromAccountId, $convertedDate);
            }
        });
    }
}