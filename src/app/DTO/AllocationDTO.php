<?php

namespace App\DTO;

use DateTime;
use Illuminate\Http\Request;

readonly class AllocationDTO
{
    public function __construct(
        public int $categoryId,
        public int $amount,
        public ?int $toAccountId = null,
    )
    {
        throw new \Exception('Not implemented');
    }
}