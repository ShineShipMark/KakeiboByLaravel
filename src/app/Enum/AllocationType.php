<?php

namespace App\Enum;

enum AllocationType: string
{
    case Fixed = 'fixed';
    
    case Percentage = 'percentage';
}
