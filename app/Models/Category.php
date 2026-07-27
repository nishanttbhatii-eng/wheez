<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'sub_page_no',
        'parent_id',
        'description',
        'short_description',
        'user_id',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_description',
    ];

    protected $casts = [
        'status' => 'integer',
        'parent_id' => 'integer',
        'sub_page_no' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id')->orderBy('name');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class, 'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function scopeRoots($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('parent_id')->orWhere('parent_id', 0);
        });
    }

    public function isRoot(): bool
    {
        return empty($this->parent_id);
    }
}
