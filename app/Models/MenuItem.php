<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class MenuItem extends Model
{
    protected $fillable = [
        'parent_id',
        'title',
        'url',
        'location',
        'type',
        'order',
        'is_active',
        'open_in_new_tab',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'open_in_new_tab' => 'boolean',
        'order' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(MenuItem::class, 'parent_id')->orderBy('order');
    }

    public function activeChildren(): HasMany
    {
        return $this->children()->where('is_active', true);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeLocation($query, string $location)
    {
        return $query->where('location', $location);
    }

    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public static function treeForLocation(string $location): Collection
    {
        $items = static::query()
            ->active()
            ->location($location)
            ->with(['children' => fn ($q) => $q->active()->with(['children' => fn ($q) => $q->active()->orderBy('order')])->orderBy('order')])
            ->roots()
            ->ordered()
            ->get();

        return $items;
    }

    public function hasDropdown(): bool
    {
        return in_array($this->type, ['menu', 'group'], true) && $this->activeChildren->isNotEmpty();
    }
}
