<?php

namespace App\Data\Budget;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\DataCollection;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType;

#[TypeScript]
class MonthlyBudgetRolloverRequestData extends Data
{
    public function __construct(
        /** 対象年月 (例: "2026-08") */
        public string $targetYearMonth,

        /** 各カテゴリ予算の繰り越しアクション配列 */
        #[TypeScriptType('Array<RolloverActionData>')]
        /** @var DataCollection<int, RolloverActionData> */
        public DataCollection $actions,
    ) {}

    public static function rules(): array
    {
        return [
            'targetYearMonth' => ['required', 'date_format:Y-m'],
            'actions' => ['required', 'array', 'min:1'],
        ];
    }
}