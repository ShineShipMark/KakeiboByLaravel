<?php

namespace App\Services;

use App\Data\Allocation\AllocationItemData;
use App\Data\Transaction\TransactionData;
use App\Data\Transaction\TransactionFilterData;
use App\Enum\TransactionType;
use App\Models\Account;
use App\Models\Transaction;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Spatie\LaravelData\PaginatedDataCollection;

class TransactionService
{
    /**
     * ページ数で制限された取得結果を返す
     * @param TransactionFilterData $filters 検索条件
     * @param int $perPage 1っページあたりの表示件数
     * @return PaginatedDataCollection 取得結果
     */
    public function getPaginatedTransactions(TransactionFilterData $filters, int $perPage = 20): PaginatedDataCollection
    {
        // ドメインモデルの各ロジック(categoryなど)からリレーション定義を取得して、
        // 関連するキーでHWEREしたSELECTで自動取得してくれる
        // (キーとなる外部キーはドメイン名+_idで自動で認識してくれる。category_idなど)
        $query = Transaction::with(['category','fromAccount', 'toAccount'])
            ->orderBy('date', 'desc')
            ->orderBy('id', 'desc');    

        if ($filters->startDate) {
            $query->where('date', '>=', $filters->startDate);
        }

        if ($filters->endDate) {
            $query->where('date', '=<', $filters->endDate);
        }

        if ($filters->type !== TransactionType::All) {
            $query->where('type', $filters->type);
        }

        if ($filters->categoryId) {
            $query->where('category_id', $filters->categoryId);
        }

        // 特定の口座・財布に関わる取引（出金元 OR 入金先）
        if (!empty($filters->accountId)) {
            $query->where(function ($q) use ($filters) {
                $q->where('from_account_id', $filters->accountId)
                  ->orWhere('to_account_id', $filters->accountId);
            });
        }

        $paginator = $query->paginate($perPage)->withQueryString();

        return TransactionData::collect($paginator, PaginatedDataCollection::class);
    }

    /**
     * 新規登録
     * @param TransactionData $data 登録するデータ
     * @return TransactionData 登録済みデータ
     */
    public function createTransaction(TransactionData $data): TransactionData
    {
        return DB::transaction(function () use($data){
            $transaction = new Transaction([
                'type'=>$data->type,
                'amount'=>$data->amount,
                'date'=>$data->date,
                'from_account_id'=>$data->fromAccountId,
                'to_account_id'=>$data->toAccountId,
                'category_id'=>$data->categoryId,
                'description'=>$data->description,
                'parent_transaction_id' =>$data->parentTransactionId,
            ]);

            $transaction->validateInvariants();
            $transaction->save();

            $this->applyBalanceChanges($data);

            return TransactionData::fromModel($transaction);
        });
    }

    /**
     * 記録の更新・修正
     * @param int $id 登録ID
     * @param TransactionData $newData 新しく更新するためのデータ
     * @return TransactionData 修正した新しいデータ
     */
    public function updateTransaction(int $id, TransactionData $newData): TransactionData
    {
        return DB::transaction(function() use($id, $newData) {
            $transaction = Transaction::findOrFail($id);

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

    /**
     * データの削除
     * @param int $id 削除対象のID
     * @return void
     */
    public function deleteTransaction(int $id): void
    {
        DB::Transaction(function() use ($id){
            $transaction = Transaction::findOrFail($id);
            $data = TransactionData::fromModel($transaction);

            $this->revertBalanceChange($data);

            $transaction->delete();
        });
    }

    /**
     * 取引の種別に応じた口座残高の加減(出費・振替で減って、収入・振替で増えるという計算を行う)
     * @param TransactionData $data
     * @return void
     */
    private function applyBalanceChanges(TransactionData $data): void
    {
        if ($data->fromAccountId && in_array($data->type, [TransactionType::Expense, TransactionType::Transfer])) {
            Account::where('id', $data->fromAccountId)->decrement('balance', $data->amount);
        }

        if ($data->toAccountId && in_array($data->type, [TransactionType::Income, TransactionType::Transfer])) {
            Account::where('id', $data->toAccountId)->increment('balance', $data->amount);
        }
    }

    /**
     * 取引のデータ削除・修正時に口座残高を元に戻す(出費・振替を削除で増えて、収入・振替削除で減るという計算を行う)
     * @param TransactionData $data
     * @return void
     */
    private function revertBalanceChange(TransactionData $data): void 
    {
        if ($data->fromAccountId && in_array($data->type, [TransactionType::Expense, TransactionType::Transfer])) {
            Account::where('id', $data->fromAccountId)->increment('balance', $data->amount);
        }

        if ($data->toAccountId && in_array($data->type, [TransactionType::Income, TransactionType::Transfer])) {
            Account::where('id', $data->toAccountId)->decrement('balance', $data->amount);
        }
    }
}