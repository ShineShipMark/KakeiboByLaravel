<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'parent_id',
        'name',
        'type',
        'sort_order'
    ];

    public function parent():BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children():HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('sort_order');
    }

    public function scopeMainCategories($query, string $type = null)
    {
        $query->whereNull('parent_id');
        if($type) {
            $query->where('type', $type);
        }

        return $query;
    }
}
