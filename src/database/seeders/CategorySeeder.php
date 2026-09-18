<?php

namespace Database\Seeders;

use App\Enum\CategoryType;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. 収入 (Income)
        $salaryParent = Category::create([
            'name' => '給料',
            'type' => CategoryType::Income,
            'parent_id' => null,
        ]);

        $this->createChildren($salaryParent->id, CategoryType::Income, [
            '基本給',
            '賞与',
            '建て替え戻し',
        ]);

        // 💡 2. 収入からの天引き・固定費控除 (Income) -> 親子ともに Income で統一！
        $incomeDeductionParent = Category::create([
            'name' => '給料からの各種費用差し引き',
            'type' => CategoryType::Income,
            'parent_id' => null,
        ]);

        $this->createChildren($incomeDeductionParent->id, CategoryType::Income, [
            '奨学金',
            'スマホ料金',
            '保険',
            '家賃',
        ]);

        // 3. 支出: 趣味 (Expense)
        $hobbyParent = Category::create([
            'name' => '趣味',
            'type' => CategoryType::Expense,
            'parent_id' => null,
        ]);

        $this->createChildren($hobbyParent->id, CategoryType::Expense, [
            '外食(趣味)',
            '雑貨・道具',
            '課金・ゲーム',
            'グッズ',
            '釣り',
            '同人・本・動画',
            '旅行・ライブ',
            '燃料・交通費(趣味)',
            'AV・PC機器(趣味)',
            'サブスク(趣味)',
            '貯金送金',
            'その他(趣味)',
        ]);

        // 4. 支出: 雑費 (Expense)
        $sundryParent = Category::create([
            'name' => '雑費',
            'type' => CategoryType::Expense,
            'parent_id' => null,
        ]);

        $this->createChildren($sundryParent->id, CategoryType::Expense, [
            '食料品',
            '雑貨',
            '外食',
            '仕事用諸経費',
            '勉強用',
            '燃料・交通費',
            '病院関連',
            '貯金送金',
            'サブスク',
            '医薬品・サプリ類',
            'AV・PC機器',
            'その他',
            '税金',
            '車関係',
        ]);

        // 5. 振替 / 貯金目標 (Transfer)
        $transferParent = Category::create([
            'name' => '貯金先送金',
            'type' => CategoryType::Transfer,
            'parent_id' => null,
        ]);

        $this->createChildren($transferParent->id, CategoryType::Transfer, [
            '趣味貯金',
            '諸貯金',
        ]);
    }

    /**
     * 子カテゴリを一括作成するヘルパーメソッド
     */
    private function createChildren(int $parentId, CategoryType $type, array $names): void
    {
        foreach ($names as $name) {
            Category::create([
                'name' => $name,
                'type' => $type,
                'parent_id' => $parentId,
            ]);
        }
    }
}