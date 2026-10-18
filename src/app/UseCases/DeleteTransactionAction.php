<?php

namespace App\UseCases;

use App\Services\AllocationService;
use App\Services\TransactionService;
use Illuminate\Support\Facades\DB;

class DeleteTransactionAction
{
    public function __construct(
        private TransactionService $transactionService,
        private AllocationService $allocationService,
    )
    {
    }

    public function __invoke(int $id): void
    {
        DB::transaction(function() use($id){
            $this->allocationService->deleteAllocations($id);
            $this->transactionService->deleteTransaction($id);
        });
    }
}