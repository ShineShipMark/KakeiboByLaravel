<?php
namespace App\Enum;

enum CategoryType: string
{
    case Income = 'income';   // 収入カテゴリ
    case Expense = 'expense'; // 支出カテゴリ
    case Transfer = 'transfer'; // 振替カテゴリ（必要な場合）

    /**
     * ラベル取得（UI表示用）
     */
    public function label(): string
    {
        return match ($this) {
            self::Income => '収入',
            self::Expense => '支出',
            self::Transfer => '振替',
        };
    }
}