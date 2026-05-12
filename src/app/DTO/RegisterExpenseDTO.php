<?php

namespace App\DTO;

use DateTime;
use Illuminate\Http\Request;

readonly class RegisterExpenseDTO
{
    public function __construct(
        public int $id,
        public int $expense_purpose_id,
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
            expense_purpose_id:$request->int('expense_purpose_id'),
            amount:$request->int('amount'),
            at_date:$request->DateTime('at_date'),
            possession:$request->string('possession'),
            detail:$request->string('detail')
        );
    }

    public function toArray(): array
    {
        return [
            'id'=>$this->id,
            'expense_purpose_id'=>$this->expense_purpose_id,
            'amount'=>$this->amount,
            'at_date'=>$this->at_date,
            'possession'=>$this->possession,
            'detail'=>$this->detail
        ];
    }
}