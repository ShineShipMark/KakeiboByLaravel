<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable=['expense_purpose_id','amount','date_time','possession','detail'];

    public function expensesPurpose()
    {
        return $this->belongsTo(ExpensePurpose::class);
    }
}
