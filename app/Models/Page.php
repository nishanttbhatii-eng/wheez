<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'featured_image',
        'status',
        'order',
        'seo_title',
        'seo_description',
        'author_id',
        'meta_title',
        'meta_description',
        'og_title',
        'og_description',
        'og_image_url',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('order');
    }

    public function getDocumentTitleAttribute(): string
    {
        return $this->meta_title
            ?: $this->seo_title
            ?: $this->title
            ?: config('app.name', 'Whizseed');
    }

    public function getMetaDescriptionTextAttribute(): ?string
    {
        return $this->meta_description ?: $this->seo_description;
    }

    public function getOgTitleTextAttribute(): string
    {
        return $this->og_title ?: $this->document_title;
    }

    public function getOgDescriptionTextAttribute(): ?string
    {
        return $this->og_description ?: $this->meta_description_text;
    }

    public function getOgImageAttribute(): ?string
    {
        if ($this->og_image_url) {
            return $this->og_image_url;
        }

        if ($this->featured_image) {
            return asset('storage/' . $this->featured_image);
        }

        return asset('Image/logo.png');
    }
}
