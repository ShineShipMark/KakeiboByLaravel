<?php
namespace App\Enum;

use Spatie\TypeScriptTransformer\Attributes\TypeScript;

#[TypeScript]
enum TransactionType: string
{
    case Income = 'income';
    case Expense = 'expense';
    case Transfer = 'transfer';
}