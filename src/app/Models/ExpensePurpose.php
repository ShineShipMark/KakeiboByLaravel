<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpensePurpose extends Model
{
    /** @use HasFactory<\Database\Factories\ExpensePurposeFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable=['purpose','expense_category_id'];

    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }

    public function expensesCategory()
    {
        return $this->belongsTo(ExpenseCategory::class);
    }
}
