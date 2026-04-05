<?php

namespace App\DTO;

use DateTime;
use Illuminate\Http\Request;

readonly class FindExpenseDTO
{
    public function __construct(
        public int $id,
        public int $expense_purpose_id,
        public int $amount,
        public DateTime $first_date_time,
        public DateTime $last_date_time,
        public string $possession,
        public string $detail
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            id:$request->interger('id'),
            expense_purpose_id:$request->int('expense_purpose_id'),
            amount:$request->int('amount'),
            first_date_time:$request->DateTime('first_date_time'),
            last_date_time:$request->DateTime('last_date_time'),
            possession:$request->string('possession'),
            detail:$request->string('detail')
        );
    }
}