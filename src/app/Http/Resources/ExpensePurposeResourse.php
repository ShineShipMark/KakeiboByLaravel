<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpensePurposeResourse extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'purpose'=>$this->purpose,
            'category'=>new ExpenseCategoryResourse($this->whenLoaded('expenseCategory'))
        ];
    }
}
