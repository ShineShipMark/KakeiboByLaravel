<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use InvalidArgumentException;

class Budget extends Model
{
    protected $fillable = ['category_id', 'year_month', 'amount','carryover_amount','is_closed'];

    protected $casts = [
        'amount' => 'decimal:2',
        'carryover_amount'=> 'decimal:2',
        'is_close' => 'boolean'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function updateAmount(float $newAmount): void
    {
        if ($newAmount < 0) {
            throw new InvalidArgumentException('予算がマイナス');
        }

        $this->amount = $newAmount;
    }

    public function calculateUsageRate(float $spentAmount): float
    {
        $budgetAmount = (float) $this->amount;

        if ($budgetAmount <= 0) {
            return 0.0;
        }

        return round(($spentAmount / $budgetAmount) * 100, 1);
    }

    public function isOverBudget(float $spentAmount): bool
    {
        return $spentAmount > (float) $this->amount;
    }

    public function calculateRemainingAmount(float $spentAmount): float
    {
        return (float) $this->amount - $spentAmount;
    }

    public function totalAmount():Attribute
    {
        return Attribute::make(
            get:fn()=>(float) $this->amount + (float) $this->carryover_amount,
        );
    }
}
