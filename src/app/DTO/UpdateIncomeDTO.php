<?php

namespace App\DTO;

use App\Http\Requests\HistoryRequest;
use DateTime;

readonly class UpdateIncomeDTO
{
    public function __construct(
        public int $id,
        public int $income_purpose_id,
        public int $amount,
        public DateTime $at_date,
        public string $possession,
        public string $detail) {}

    public static function fromRequest(int $id, HistoryRequest $request): self
    {
        return new self(
            id: $id,
            income_purpose_id:$request->int('purpose_id'),
            amount:$request->int('amount'),
            at_date:$request->DateTime('at_date'),
            possession:$request->string('possession'),
            detail:$request->string('detail')
        );
    }

     public function toArray() :array
    {
        return [
            'purpose_id'=>$this->income_purpose_id,
            'amount'=>$this->amount,
            'at_date'=>$this->at_date,
            'possession'=>$this->possession,
            'detail'=>$this->detail
        ];
    }
}