<?php

namespace App\Data\Budget;

use App\Enum\RolloverActionType;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class RolloverActionData extends Data
{
    public function __construct(
        /** 対象の予算ID (Budget.id) */
        public int $budgetId,

        /** アクション種別 (carryover / savings / discard) */
        public RolloverActionType $actionType,

        /** 余剰金 (またはマイナス額) */
        public float $surplusAmount,

        /** 
         * 貯金指定時の移動先カテゴリID (actionType が SAVINGS の場合のみ指定)
         */
        public ?int $targetSavingsCategoryId = null,

        /** 
         * 実際に適用する金額 (一部のみ繰り越す場合などの拡張用)
         */
        #[Min(0)]
        public ?float $customAmount = null,
    ) {}

    public static function rules(): array
    {
        return [
            'budgetId' => ['required', 'integer', 'exists:budgets,id'],
            'actionType' => ['required'],
            'surplusAmount' => ['required', 'numeric'],
            'targetSavingsCategoryId' => [
                'nullable',
                'required_if:actionType,' . RolloverActionType::SAVINGS->value,
                'integer',
                'exists:categories,id',
            ],
            'customAmount' => ['nullable', 'numeric', 'min:0'],
        ];
    }
}