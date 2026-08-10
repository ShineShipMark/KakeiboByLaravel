<?php
namespace App\Enum;
use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
enum AccountType: string
{
    case Bank = 'bank';
    case Cash = 'cash';
    case EMoney = 'e_money';
    case CreditCard = 'credit_card';
}