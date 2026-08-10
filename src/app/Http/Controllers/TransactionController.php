<?php

namespace App\Http\Controllers;

use App\Data\Transaction\TransactionData;
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

    public function index(Request $request): Response
    {
        $filters = $request->only([
            'keyword',
            'year_month',
            'type',
            'category_id',
            'account_id',
        ]);

        $transactions = $this->transactionService->getPaginatedTransactions($filters);

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

    public function store(TransactionData $data)
    {
        $this->transactionService->createTransaction($data);

        return redirect()->route('transaction.index')->with('success', '登録完了');
    }
}
