<?php

namespace App\Enum;

use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
enum RolloverActionType: string
{
    case CARRYOVER = 'carryover'; // 翌月の同カテゴリ予算へ繰り越し
    case SAVINGS   = 'savings';   // 貯金用カテゴリ/口座へ移動
    case DISCARD   = 'discard';   // 繰り越さず破棄 (0としてリセット)
}