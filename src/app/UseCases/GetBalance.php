<?php
namespace App\UseCases;
use App\Services\AccountBalanceService;

class GetBalance
{
    public function __construct(private AccountBalanceService $accountBalanceService)
    {
        throw new \Exception('Not implemented');
    }

    public function handle(): array
    {
        $accountAmount = $this->accountBalanceService->getAccountSummary(1);

        $cashAmount = $this->accountBalanceService->getAccountSummary(5);

        return [
            'accountamount'=>$accountAmount,
            'cashAmount'=> $cashAmount,
        ];
    }
}