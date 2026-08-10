<?php

namespace App\Data\Budget;

use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Attributes\Validation\Required;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class CreateBudgetRequestData extends Data
{
    public function __construct(
        #[Required]
        public int $categoryId,
        #[Required, Min(1)]
        public int $amount,

        #[Required]
        public string $yearMonth,
    ) {}

    public static function rules(): array
    {
        return [
            'category_id' => ['required', 'exists:categories,id'],
            'year_month' => ['required', 'date_format:Y-m'],
        ];
    }
}
