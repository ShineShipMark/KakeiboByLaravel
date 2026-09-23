<?php
namespace App\Enums;

use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
enum AccountId: int
{
    case Cash = 1;         // ID: 1 は必ず「現金財布」
    case MainBank = 2;     // ID: 2 は必ず「メイン口座」
}