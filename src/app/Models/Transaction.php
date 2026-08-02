<?php

namespace App\Models;

use App\Enum\TransactionType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use InvalidArgumentException;
use phpDocumentor\Reflection\Types\Boolean;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'from_account_id',
        'to_account_id',
        'category_id',
        'amount',
        'date',
        'description'
    ];

    protected $casts = [
        'type' => TransactionType::class,
        'amount'=>'decimal:2',
        'date'=>'date'
    ];

    protected function fromAccount():BelongsTo
    {
        return $this->belongsTo(Account::class, 'from_account_id');
    }

    protected function toAccount(): BelongsTo
    {
        return $this->belongsTo(Account::class, 'to_account_id');
    }

    protected function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function valodateInvariants():void
    {
        if($this->amount <= 0){
            throw new InvalidArgumentException('金額が0より小さい');
        }

        if($this->type === TransactionType::Expense && !$this->from_account_id){
            throw new InvalidArgumentException('出金元口座が存在しない');
        }

        if($this->type === TransactionType::Income && !$this->to_account_id){
            throw new InvalidArgumentException('入金咲口座が存在しない');
        }

        if($this->type === TransactionType::Transfer && !$this->to_account_id){
            if(!$this->from_account_id || !$this->to_account_id){
                throw new InvalidArgumentException('振替元も先も存在しない');
            }

            if(!$this->to_account_id === $this->to_account_id){
                throw new InvalidArgumentException('同一口座での振替は出来ない');
            }
        }
    }

    public function isIncome():bool
    {
        return $this->type === TransactionType::Income;
    }

    public function isExpense():bool
    {
        return $this->type === TransactionType::Expense;
    }

    public function isTransfer():bool
    {
        return $this->type === TransactionType::Transfer;
    }

    public function getBalanceImpactForAccount(int $accountId):float
    {
        $amount = (float) $this->amount;

        if($this->to_account_id === $accountId) {
            return $amount;
        }

        if ($this->from_account_id === $accountId) {
            return -$amount;
        }

        return 0.0;
    }
}
