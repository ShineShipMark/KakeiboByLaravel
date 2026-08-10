<?php

namespace App\Enum;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
enum AllocationType: string
{
    case Fixed = 'fixed';
    
    case Percentage = 'percentage';
}
