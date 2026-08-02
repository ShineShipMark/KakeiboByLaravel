<?php
namespace App\Enum;

enum TransactionType: string
{
    case Income = 'income';
    case Expense = 'expense';
    case Transfer = 'transfer';
}