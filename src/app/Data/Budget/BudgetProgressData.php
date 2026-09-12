<?php

namespace App\Data\Budget;

use App\Models\Category;
use App\ValueObjects\BillingPeriod;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class BudgetProgressData extends Data
{
    public function __construct(
        public int $categoryId,
        public string $categoryName,
        public int $baseBudgetAmount,    // 基本設定額
        public int $carryoverAmount,     // 💡 追加: 前月からの繰越額
        public int $totalBudgetAmount,
        public int $spentAmount,
        public int $remainingAmount,
        public float $usageRate,
        public bool $isOver,
    ) {}

    public static function fromCategory(Category $category, BillingPeriod $period, string $yearMonth): self
    {
        $budget = $category->budgets->firstWhere('year_month', $yearMonth);
        $totalSpent = $category->calculateTotalSpentForPeriod($period);
        $baseAmount = $budget ? (int) $budget->amount : 0;
        $carryoverAmount = $budget ? (int) $budget->carryover_amount : 0; // 💡 繰越額を取得
        $totalBudget = $baseAmount + $carryoverAmount; // 💡 実質合計予算

        return new self(
            categoryId: $category->id,
            categoryName: $category->name,
            baseBudgetAmount: $baseAmount,
            carryoverAmount: $carryoverAmount,
            totalBudgetAmount: $totalBudget,
            spentAmount: $totalSpent,
            remainingAmount: max(0, $totalBudget - $totalSpent),
            usageRate: $totalBudget > 0 ? round(($totalSpent / $totalBudget) * 100, 1) : 0.0,
            isOver: $totalBudget > 0 && $totalSpent > $totalBudget,
        );
    }
}