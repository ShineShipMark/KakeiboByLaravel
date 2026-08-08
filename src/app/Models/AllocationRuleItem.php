<?php
namespace App\Models;

use App\Enum\AllocationType;
use App\Enum\TransactionType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AllocationRuleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'allocation_rule_id',
        'to_account_id',
        'category_id', // タイポ修正
        'type',
        'amount',
        'percentage',
        'priority',
    ];

    protected $casts = [
        'type'       => AllocationType::class,
        'amount'     => 'decimal:2',
        'percentage' => 'float',
        'priority'   => 'integer',
    ];

    /* =========================================================================
     * リレーション
     * ========================================================================= */

    public function allocationRule(): BelongsTo
    {
        return $this->belongsTo(AllocationRule::class);
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
     * ドメインロジック
     * ========================================================================= */

    /**
     * 基準額（給与など）をもとに、定額または割合に応じて配分金額を算出する
     */
    public function calculateAmount(float $baseAmount = 0.0): float
    {
        if ($this->type === AllocationType::Fixed) {
            return (float) $this->amount;
        }

        if ($this->type === AllocationType::Percentage) {
            if ($baseAmount <= 0) {
                return 0.0;
            }
            return round($baseAmount * ($this->percentage / 100), 2);
        }

        return 0.0;
    }

    public function createTransaction(int $fromAccountId, int $sourceAmount, Carbon $executeDate): ?Transaction
    {
        $allocatedAmount = $this->calculateAmount($sourceAmount);

        if ($allocatedAmount <= 0) {
            return null;
        }

        return new Transaction([
            'from_account_id'  => $fromAccountId,
            'to_account_id' =>  $this->to_account_id,
            'category_is' => $this->category_id,
            'amount' =>  $allocatedAmount,
            'type' => TransactionType::Transfer,
            'date' => $executeDate->toDateString(),
            'description' => "自動配分: {$this->name}",

        ]);
    }
}