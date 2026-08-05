<?php
namespace App\Models;

use App\Enum\CategoryType; // ★ 追加
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
     * @param CategoryType|string|null $type
     */
    public function scopeMainCategories($query, CategoryType|string $type = null)
    {
        $query->whereNull('parent_id');

        if ($type) {
            // Enum インスタンスまたは文字列のどちらが渡されても安全に処理
            $typeValue = $type instanceof CategoryType ? $type->value : $type;
            $query->where('type', $typeValue);
        }

        return $query;
    }

    public function isIncome(): bool
    {
        return $this->type === CategoryType::Income;
    }

    public function isExpense(): bool
    {
        return $this->type === CategoryType::Expense;
    }
}