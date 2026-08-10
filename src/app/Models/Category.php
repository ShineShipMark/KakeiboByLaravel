<?php
namespace App\Models;

use App\Enum\CategoryType; // ★ 追加
use App\Enum\TransactionType;
use App\ValueObjects\BillingPeriod;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'name',
        'type',
        'sort_order',
    ];

    // ★ Enum 型キャストの追加
    protected $casts = [
        'type' => CategoryType::class,
        'sort_order' => 'integer',
    ];

    /* =========================================================================
     * リレーション
     * ========================================================================= */

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order');
    }

    public function budgets(): HasMany
    {
        return $this->hasMany(Budget::class);
    }

    public function childTransactions(): HasManyThrough
    {
        return $this->hasManyThrough(
            Transaction::class,
            Category::class,
            'parent_id',
            'category_id',
            'id',
            'id'
        );
    }

    /* =========================================================================
     * スコープ & ドメインロジック
     * ========================================================================= */

    /**
     * 大項目（親カテゴリがないもの）のみを取得するスコープ
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     */
    public function scopeMainCategories(Builder $query): Builder
    {
        return $query->whereNull('parent_id');
    }

    public function scopeSubCategories(Builder $query): Builder
    {
        return $query->whereNotNull('parent_id');
    }

    public function isIncome(): bool
    {
        return $this->type === CategoryType::Income;
    }

    public function isExpense(): bool
    {
        return $this->type === CategoryType::Expense;
    }

    public function calculateTotalSpentForPeriod(BillingPeriod $period): int
    {
        $directSpent = $this->transactions()
            ->where('type', TransactionType::Expense)
            ->whereBetween('date', [$period->startDate, $period->endDate])
            ->sum('amount');

        $childSpent = $this->childTransactions()
            ->where('type', TransactionType::Expense)
            ->sum('amount');
        
        return $directSpent + $childSpent;
    }

    public function calculateBudgetProgress(BillingPeriod $period, string $yearMonth): array
    {
        $budget = $this->budgets->firstWhere('year_month', $yearMonth);
        $totalSpent = $this->calculateTotalSpentForPeriod($period);
        $budgetAmount = $budget ? $budget->amount : 0;

        return [
            'category_id' => $this->id,
            'category_name'=> $this->name,
            'budget_amount' => $budgetAmount,
            'spent_amount' => $totalSpent,
            'remaining_amount' => max(0, $budgetAmount - $totalSpent),
            'usage_rate' => $budget ? $budget->calculateUsageRate($totalSpent) : 0,
            'is_over' => $budget ? $budget->isOverBudget($totalSpent) : false,
        ];
    }
}