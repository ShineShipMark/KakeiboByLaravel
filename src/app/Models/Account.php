<?php

namespace App\Models;

use App\Enum\AccountType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use InvalidArgumentException;

class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'balance',
        'is_active',
    ];

    protected $casts = [
        'type' => AccountType::class,
        'balance' => 'decimal:2',  
    ];

    public function savingGoals(): HasMany
    {
        return $this->hasMany(SavingGoal::class)->orderBy('sort_order');
    }

    public function getUnallocatedBalanceAttribute(): float
    {
        $allocatedSum = $this->savingGoals()->sum('current_amount');
        return (float) ($this->balance - $allocatedSum);
    }

    public function outgoingTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'from_account_id');
    }

    public function incomingTransactions(): HasMany
    {
        return $this->hasMany(Transaction::class, 'to_account_id');
    }

    public function deposit(float $amount): void
    {
        if($amount <= 0){
            throw new InvalidArgumentException('入金金額がマイナスになっている');
        }

        $this->balance = (float) $this->balance + $amount;
    }

    public function withdraw(float $amount): void
    {
        if($amount<=0){
            throw new InvalidArgumentException(('出金金額がマイナスになっている'));
        }

        if(!$this->canOverdraw() && ((float) $this->balance - $amount)<0){
            throw new InvalidArgumentException('残高不足');
        }

        $this->balance = (float) $this->balance - $amount;
    }

    public function canOverdraw(): bool
    {
        return $this->type === AccountType::CreditCard;
    }

    public function isCash():bool
    {
        return $this->type === AccountType::Cash;
    }
}
