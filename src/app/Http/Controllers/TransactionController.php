<?php

namespace App\Http\Controllers;

use AllocationService;
use App\Data\Transaction\TransactionData;
use App\Data\Transaction\TransactionFilterData;
use App\Models\Account;
use App\Models\Category;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function __construct(
        private readonly TransactionService $transactionService
    )
    {
        throw new \Exception('Not implemented');
    }

    public function index(TransactionFilterData $filters, TransactionService $service): Response
    {
        $transactions = $service->getPaginatedTransactions($filters);

        return Inertia::render('Transaction/Index', [
            'transactions' => $transactions,
            'filters' => $filters,
            'categories' => Category::all(),
            'accounts' => Account::all(),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Transaction/Create', [
            'accounts' => Account::all(),
            'categories' => Category::all(),
        ]);
    }

    public function store(TransactionData $data, TransactionService $transactionService, AllocationService $allocationService)
    {
       DB::transaction(function () use ($data, $transactionService, $allocationService){
            $transactionService->createTransaction($data);

            if (!empty($data->allocations)) {
                $executeDate = new Carbon($data->date);
                $allocationService->executeCustomAllocation($data->allocations, $data->fromAccountId, $executeDate);
            }
        });
        return redirect()->route('transaction.index')->with('success', '登録完了');
    }

    public function update(int $id, TransactionData $data,TransactionService $transactionService, AllocationService $allocationService)
    {
        DB::transaction(function () use ($id, $data, $transactionService, $allocationService){
            $transactionService->updateTransaction($id,$data);

            if (!(empty($data->allocations))) {
                $convertedDate = new Carbon($data->date);
                $allocationService->updateAllocations($id, $data->allocations, $data->fromAccountId, $convertedDate);
            }
        });

        return redirect()->back()->with('success', '編集完了');
    }
}
