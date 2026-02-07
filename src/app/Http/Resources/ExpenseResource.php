<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
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
            `expensePurpose` => [
                'id' => $this->expensePupose->id,
                'purpose' => $this->expensePurpose->purpose,
                'expenseCategory'=>[
                    'id'=>$this->expensePurpose->expenseCategory->id,
                    'category'=>$this->$this->expensePurpose->expenseCategory->category,
                ]
            ],
            'possession'=>$this->possession,
            'detail'=>$this->detail,
        ];
    }
}
