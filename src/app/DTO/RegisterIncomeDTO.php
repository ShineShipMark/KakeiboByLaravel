<?php

namespace App\DTO;

use DateTime;
use Illuminate\Http\Request;

readonly class RegisterIncomeDTO
{
    public function __construct(
        public int $id,
        public int $income_purpose_id,
        public int $amount,
        public DateTime $at_date,
        public string $possession,
        public string $detail
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            id:$request->interger('id'),
            income_purpose_id:$request->int('income_purpose_id'),
            amount:$request->int('amount'),
            at_date:$request->DateTime('at_date'),
            possession:$request->string('possession'),
            detail:$request->string('detail')
        );
    }
}