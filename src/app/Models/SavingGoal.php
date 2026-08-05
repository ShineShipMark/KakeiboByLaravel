<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SavingGoal extends Model
{
    protected $fillable = [
        'account_id',
        'name',
        'target_amount',
        'current_amount',
        'target_date',
        'sort_order',
    ];

    public function account():BelongsTo
    {
        return $this->belongsTo(Account::class);
    }

    public function getProgressRateAttribute():float
    {
        if (!$this->target_amount || $this->target_amount <= 0) {
            return 0.0;
        }

        $rate = ($this->current_amount / $this->target_amount) * 100;
        return min(round($rate, 1), 100.0);
    }
}
