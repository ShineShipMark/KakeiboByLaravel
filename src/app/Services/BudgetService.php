<?php 

namespace App\Services;

use App\Data\Budget\BudgetProgressData;
use App\Models\Budget;
use App\Models\Category;
use App\ValueObjects\BillingPeriod;
use Spatie\LaravelData\DataCollection;

class BudgetService
{
    /**
     * 月ごとのカテゴリごとの『設定予算』『支出金額』『残り予算』『予算の割合』について一覧でまとめて取得
     * @param string $yearMonth 月の指定
     * @return DataCollection 一覧
     */
    public function getBudgetProgressList(string $yearMonth): DataCollection
    {
        // 集計用の開始日・終了日をインスタンスとして保持
        $period = new BillingPeriod($yearMonth);

        // 親カテゴリ(大項目)一覧を取得し、指定年月の『予算』だけをEager Loading
        $mainCategories = Category::mainCategories()
            ->with(['budgets'=>fn($q)=>$q->where('year_month', $yearMonth)])
            ->get();

        // 各カテゴリから割合用DTOへの変換処理を行う
        $progressList = $mainCategories->map(
            // 『支出合計の計算』『残高』『割合』の計算をfromCategoryに外出し
            fn(Category $category) => BudgetProgressData::fromCategory($category, $period, $yearMonth)
        );
        
        // DTOコレクションにして返す
        return BudgetProgressData::collect($progressList);
    }

    /**
     * 予算の新規設定または更新
     * @param int $categoryId カテゴリID
     * @param int $amount 予算
     * @param string $yearMonth 支出の設定年月
     * @return Budget 予算のドメインモデル
     */
    public function saveBudget(int $categoryId, int $amount, string $yearMonth): Budget
    {
        // ドメインロジックで計算
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