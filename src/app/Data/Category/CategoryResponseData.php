<?php

namespace App\Data\Category;

use App\Enum\CategoryType;
use App\Models\Category;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Lazy;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;
use Spatie\TypeScriptTransformer\Attributes\TypeScriptType;

#[TypeScript]
class CategoryResponseData extends Data
{
    public function __construct(
        public int $id,
        public string $name,
        public CategoryType $type,
        public ?int $parentId,
        #[TypeScriptType('CategoryResponseData|null')]
        public Lazy|CategoryResponseData|null $parent,
        
        #[TypeScriptType('array<CategoryResponseData>|null')]
        public Lazy|array|null $children,
    ) {}

    /**
     * Category Eloquentモデルから CategoryResponseData へ変換するファクトリメソッド
     */
    public static function fromModel(Category $category): self
    {
        return new self(
            id:$category->id,
            name:$category->name,
            type:$category->type,
            parentId:$category->parent_id,
            parent: Lazy::whenLoaded(
                'parent', 
                $category, 
                fn() => $category->parent ? CategoryResponseData::fromModel($category->parent) : null
            ),
            children: Lazy::whenLoaded('children', $category, fn()=> CategoryResponseData::collect($category->children)),
        );
    }
}
