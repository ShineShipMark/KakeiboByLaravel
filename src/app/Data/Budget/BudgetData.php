<?php

namespace App\Data\Budget;

use App\Models\Budget;
use App\Data\Category\CategoryResponseData; // 💡 適切な DTO を use
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType;

#[TypeScript]
class BudgetData extends Data
{
    public function __construct(
        public ?int $id,
        public int $categoryId,
        public string $yearMonth,
        public float $amount,
        public float $carryoverAmount,
        public float $totalAmount,
        public bool $isClosed,
        
        #[TypeScriptType('CategoryResponseData|null')]
        public CategoryResponseData|Lazy|null $category, // 💡 型合わせ
    ) {}

    public static function fromModel(Budget $budget): self
    {
        return new self(
            id: $budget->id,
            categoryId: $budget->category_id,
            yearMonth: $budget->year_month,
            amount: (float) $budget->amount,
            carryoverAmount: (float) $budget->carryover_amount,
            totalAmount: $budget->total_amount,
            isClosed: $budget->is_closed,
            category: Lazy::whenLoaded(
                'category', 
                $budget, 
                fn () => CategoryResponseData::fromModel($budget->category)
            ),
        );
    }
}