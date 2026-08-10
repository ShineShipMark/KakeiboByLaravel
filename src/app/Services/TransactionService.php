<?php

namespace App\Services;

use App\Data\Transaction\TransactionData;
use App\Enum\TransactionType;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function getPaginatedTransactions(array $filters = [], int $perPage = 20): LengthAwarePaginator
    {
        $query = Transaction::with(['category','fromAccount', 'toAccount'])
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc');    

        if (!empty($filters['year_month'])) {
            $query->where('date', 'like', $filters['year_month'] . '%');
        }

        if (!empty($filters['type'])) {
            $query->where('type', $filters['type']);
        }

        if (!empty($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        // 特定の口座・財布に関わる取引（出金元 OR 入金先）
        if (!empty($filters['account_id'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('from_account_id', $filters['account_id'])
                  ->orWhere('to_account_id', $filters['account_id']);
            });
        }

        return $query->paginate($perPage)
            ->appends($filters)
            ->through(fn(Transaction $transaction) => TransactionData::fromModel($transaction)
        );
    }


    public function createTransaction(TransactionData $data): TransactionData
    {
        return DB::transaction(function () use($data){
            $transaction = Transaction::create([
                'type'=>$data->type,
                'amount'=>$data->amount,
                'date'=>$data->date,
                'from_account_id'=>$data->fromAccountId,
                'to_account_id'=>$data->toAccountId,
                'category_id'=>$data->categoryId,
                'description'=>$data->description,
            ]);

            $this->applyBalanceChanges($data);

            return TransactionData::fromModel($transaction);
        });
    }

    public function upadateTransaction(int $id, TransactionData $newData): TransactionData
    {
        return DB::transaction(function() use($id, $newData) {
            $transaction = Transaction::findOrFali($id);

            $oldData = TransactionData::fromModel($transaction);
            $this->revertBalanceChange($oldData);

            $transaction->update([
                'type'=>$newData->type,
                'amount'=>$newData->amount,
                'date'=>$newData->date,
                'from_account_id'=>$newData->fromAccountId,
                'to_account_id'=>$newData->toAccountId,
                'category_id'=>$newData->categoryId,
                'description'=>$newData->description,
            ]);

            $this->applyBalanceChanges($newData);
            return TransactionData::fromModel($transaction);
        });
    }

    public function deleteTransaction(int $id): void
    {
        DB::Transaction(function() use ($id){
            $transaction = Transaction::findOrFail($id);
            $data = TransactionData::fromModel($transaction);

            $this->revertBalanceChange($data);

            $transaction->delete();
        });
    }

    private function applyBalanceChanges(TransactionData $data): void
    {
        if ($data->fromAccountId && in_array($data->type, [TransactionType::Expense, TransactionType::Transfer])) {
            Account::where('id', $data->fromAccountId)->decrement('balance', $data->amount);
        }

        if ($data->toAccountId && in_array($data->type, [TransactionType::Income, TransactionType::Transfer])) {
            Account::where('id', $data->toAccountId)->increment('balance', $data->amount);
        }
    }

    private function revertBalanceChange(TransactionData $data): void 
    {
        if ($data->fromAccountId && in_array($data->type, [TransactionType::Expense, TransactionType::Transfer])) {
            Account::where('id', $data->toAccountId)->increment('balance', $data->amount);
        }

        if ($data->toAccountId && in_array($data->type, [TransactionType::Income, TransactionType::Transfer])) {
            Account::where('id', $data->toAccountId)->decrement('balance', $data->amount);
        }
    }
}