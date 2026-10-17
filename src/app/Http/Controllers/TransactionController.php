<?php

namespace App\Http\Controllers;

use App\Services\AllocationService;
use App\Data\Transaction\TransactionData;
use App\Data\Transaction\TransactionFilterData;
use App\Models\Account;
use App\Models\Category;
use App\Services\TransactionService;
use App\UseCases\StoreTransactionAction;
use App\UseCases\UpdateTransactionAction;
use Inertia\Inertia;
use Inertia\Response;

class TransactionController extends Controller
{
    public function index(TransactionFilterData $filters, TransactionService $service): Response
    {
        $transactions = $service->getPaginatedTransactions($filters);

        return Inertia::render('history', [
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

    public function store(TransactionData $data, StoreTransactionAction $action)
    {
        $action($data);

        return redirect()->route('transaction.index')->with('success', '登録完了');
    }

    public function update(int $id, TransactionData $data, UpdateTransactionAction $action)
    {
        $action($id, $data);

        return redirect()->back()->with('success', '編集完了');
    }

    public function destroy(int $id, TransactionService $service)
    {
        $service->deleteTransaction($id);
    }
}
