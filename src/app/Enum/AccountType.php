<?php
namespace App\Enum;

enum AccountType: string
{
    case Bank = 'bank';
    case Cash = 'cash';
    case EMoney = 'e_money';
    case CreditCard = 'credit_card';
}