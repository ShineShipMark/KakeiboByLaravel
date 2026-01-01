<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomePurpose extends Model
{
    /** @use HasFactory<\Database\Factories\IncomePurposeFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable=['purpose','income_category_id'];

    public function incomes()
    {
        return $this->hasMany(Income::class);
    }

    public function incomesCategory()
    {
        return $this->belongsTo(IncomeCategory::class);
    }
}
