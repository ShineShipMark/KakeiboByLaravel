<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'at_date' => $this->at_date,
            'amount' => $this->amount,
            `incomePurpose` => [
                'id' => $this->incomePupose->id,
                'purpose' => $this->incomePurpose->purpose,
                'incomeCategory'=>[
                    'id'=>$this->incomePurpose->incomeCategory->id,
                    'category'=>$this->$this->incomePurpose->incomeCategory->category,
                ]
            ],
            'possession'=>$this->possession,
            'detail'=>$this->detail,
        ];
    }
}
