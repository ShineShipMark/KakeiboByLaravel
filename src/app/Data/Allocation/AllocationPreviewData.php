<?php

namespace App\Data\Allocation;

use Spatie\LaravelData\Attributes\Validation\Exists;
use Spatie\LaravelData\Data;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
class AllocationPreviewData extends Data
{
    public function __construct(
        #[Exists('categories', 'id')]
        public int $categoryId
    ){}
}