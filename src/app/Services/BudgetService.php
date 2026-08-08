<?php 

namespace App\Services;

use App\Models\Budget;
use App\Models\Category;
use App\ValueOjects\BillingPeriod;
use Illuminate\Support\Collection;

class BudgetService
{
    public function getBudgetProgressList(string $yearMonth): Collection
    {
        $period = new BillingPeriod($yearMonth);

        $mainCategories = Category::mainCategories()
            ->with(['budgets'=>fn($q)=>$q->where('year_month', $yearMonth)])
            ->get();
        
        return $mainCategories->map(fn(Category $category) => $category->calculateBudgetProgress($period, $yearMonth));
    }

    /**
     * 予算の新規設定または更新
     */
    public function saveBudget(int $categoryId, int $amount, string $yearMonth): Budget
    {
        return Budget::updateOrCreate(
            [
                'category_id' => $categoryId,
                'year_month' => $yearMonth,
            ],
            [
                'amount' => $amount,
            ]
        );
    }
}