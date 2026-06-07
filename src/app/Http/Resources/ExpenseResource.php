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
            'expensePurpose' => new ExpensePurposeResource($this->whenLoaded('expensePurpose')),
            'possession'=>$this->possession,
            'detail'=>$this->detail,
        ];
    }
}
