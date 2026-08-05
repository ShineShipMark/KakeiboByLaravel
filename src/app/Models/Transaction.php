<?php
namespace App\Models;

use App\Enum\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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