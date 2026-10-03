<?php
namespace App\Models;

use App\Enum\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use InvalidArgumentException;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'from_account_id',
        'to_account_id',
        'category_id',
        'amount',
        'date',
        'description',
        'parent_transaction_id',
    ];

    protected $casts = [
        'type'   => TransactionType::class,
        'amount' => 'decimal:2',
        'date'   => 'date',
    ];

    /* =========================================================================
     * リレーション (外部からアクセスするため public に変更)
     * ========================================================================= */

    public function fromAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    public function toAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'to_account_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    // 振替（移動）や自動配分によって発生した関連取引を自己結合（Self-Join）でスマートに管理する

    // 親取引(Transactionモデル同士での取引)を自己参照リレーションで定義する
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Transaction::class, 'parent_transaction_id');
    }

    // 子取引または配分操作において、親取引により発生またはそれに付随する取引を定義する
    // 例)収入登録(親)のときの分配(子)、引き出し登録(親)のときの手数料(子)など
    public function allocations():HasMany
    {
        return $this->hasMany(Transaction::class, 'parent_transaction_id');
    }

    /* =========================================================================
     * ドメインロジック (ビジネスルール)
     * ========================================================================= */

    /**
     * 不変条件（バリデーション）チェック
     */
    public function validateInvariants(): void
    {
        if ($this->amount <= 0) {
            throw new InvalidArgumentException('金額は0より大きい必要があります。');
        }

        if ($this->type === TransactionType::Expense && !$this->from_account_id) {
            throw new InvalidArgumentException('出金元口座が存在しません。');
        }

        if ($this->type === TransactionType::Income && !$this->to_account_id) {
            throw new InvalidArgumentException('入金先口座が存在しません。');
        }

        if ($this->type === TransactionType::Transfer) {
            if (!$this->from_account_id || !$this->to_account_id) {
                throw new InvalidArgumentException('振替には振替元口座と振替先口座の両方が必要です。');
            }

            if ($this->from_account_id === $this->to_account_id) {
                throw new InvalidArgumentException('同一口座間での振替はできません。');
            }
        }
    }

    public function isIncome(): bool
    {
        return $this->type === TransactionType::Income;
    }

    public function isExpense(): bool
    {
        return $this->type === TransactionType::Expense;
    }

    public function isTransfer(): bool
    {
        return $this->type === TransactionType::Transfer;
    }

    /**
     * 指定した口座に対する金額影響度を算出
     */
    public function getBalanceImpactForAccount(int $accountId): float
    {
        $amount = (float) $this->amount;

        if ($this->to_account_id === $accountId) {
            return $amount;
        }

        if ($this->from_account_id === $accountId) {
            return -$amount;
        }

        return 0.0;
    }
}