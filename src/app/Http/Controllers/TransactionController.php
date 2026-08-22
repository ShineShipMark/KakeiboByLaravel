<?php

namespace App\Http\Controllers;

use App\Data\Transaction\TransactionData;
use App\Data\Transaction\TransactionFilterData;
use App\Models\Account;
use App\Models\Category;
use App\Services\TransactionService;
use Illuminate\Http\Request;
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

    public function store(TransactionData $data, TransactionService $service)
    {
        $service->createTransaction($data);

        return redirect()->route('transaction.index')->with('success', '登録完了');
    }

    public function update(int $id, TransactionData $data,TransactionService $service)
    {
        $service->updateTransaction($id,$data);

        return redirect()->back()->with('success', '編集完了');
    }
}
