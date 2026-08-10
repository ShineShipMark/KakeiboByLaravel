<?php

namespace App\Data\Budget;

use App\Models\Category;
use App\ValueObjects\BillingPeriod;
use Spatie\LaravelData\Data;

class BudgetProgressData extends Data
{
    public function __construct(
        public int $categoryId,
        public string $categoryName,
        public int $budgetAmount,
        public int $spentAmount,
        public int $remainingAmount,
        public float $usageRate,
        public bool $isOver,
    ) {}

    public static function fromCategory(Category $category, BillingPeriod $period, string $yearMonth): self
    {
        $budget = $category->budgets->firstWhere('year_month', $yearMonth);
        $totalSpent = $category->calculateTotalSpentForPeriod($period);
        $budgetAmount = $budget ? $budget->amount : 0;

        return new self(
            categoryId: $category->id,
            categoryName: $category->name,
            budgetAmount: $budgetAmount,
            spentAmount: $totalSpent,
            remainingAmount: max(0, $budgetAmount - $totalSpent),
            usageRate: $budgetAmount > 0 ? round(($totalSpent / $budgetAmount) * 100, 1) : 0.0,
            isOver: $budgetAmount > 0 && $totalSpent > $budgetAmount,
        );
    }
}