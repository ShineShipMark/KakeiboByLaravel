<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    /** @use HasFactory<\Database\Factories\IncomeFactory> */
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable=['income_purpose_id','amount','date_time','possession','detail'];

    public function incomesPurpose()
    {
        return $this->belongsTo(IncomePurpose::class);
    }
}
