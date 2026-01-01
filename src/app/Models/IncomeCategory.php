<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    /** @use HasFactory<\Database\Factories\IncomeCategoryFactory> */
    use HasFactory;

       protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable=['category'];

    public function incomessPurpose()
    {
        return $this->hasMany(IncomePurpose::class);
    }
}
