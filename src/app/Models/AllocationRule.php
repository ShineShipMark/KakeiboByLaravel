<?php
namespace App\Models;

use App\Enum\AllocationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use InvalidArgumentException;

class AllocationRule extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'from_account_id',
        'execution_day',
        'is_active',
    ];

    protected $casts = [
        'execution_day' => 'integer',
        'is_active'     => 'boolean',
    ];

    /* =========================================================================
     * リレーション
     * ========================================================================= */

    public function fromAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(AllocationRuleItem::class)->orderBy('priority');
    }

    /* =========================================================================
     * ドメインロジック
     * ========================================================================= */

    /**
     * 割合（%）指定の項目の合計が 100% を超えていないか検証する
     */
    public function validateTotalPercentage(): void
    {
        $totalPercentage = $this->items()
            ->where('type', AllocationType::Percentage)
            ->sum('percentage');

        if ($totalPercentage > 100.0) {
            throw new InvalidArgumentException('配分割合の合計が 100% を超えています。');
        }
    }

    /**
     * 配分ルールに基づいて Transaction（下書き）のコレクションを生成する
     */
    public function generateTransaction(string $date, float $baseAmount = 0.0): Collection
    {
        if (!$this->is_active) {
            return collect();
        }

        $transactions = collect();

        foreach ($this->items as $item) {
            $allocationAmount = $item->calculateAmount($baseAmount);

            if ($allocationAmount <= 0) {
                continue;
            }

            // 配分先口座・カテゴリは $item（AllocationRuleItem）から取得する
            $transactions->push(new Transaction([
                'type'            => 'transfer',
                'from_account_id' => $this->from_account_id,
                'to_account_id'   => $item->to_account_id,
                'category_id'     => $item->category_id,
                'amount'          => $allocationAmount,
                'date'            => $date,
                'description'     => "[自動配分] {$this->name} - {$item->name}",
            ]));
        }

        return $transactions;
    }
}