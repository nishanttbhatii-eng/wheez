<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Model
{
    use HasFactory, SoftDeletes;

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
        'category_id',
        'image',
        'description',
        'short_description',
        'long_description',
        'meta_title',
        'meta_description',
        'meta_keywords',
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

    public function getUrlAttribute(): string
    {
        $slug = trim((string) $this->slug, '/');

        if ($slug === '' || $slug === 'home') {
            return route('home');
        }

        $named = [
            'about-us' => 'about',
            'contact-us' => 'contact',
            'privacy-policy' => 'privacy',
            'terms-of-services' => 'terms',
            'term-of-use' => 'terms.alias',
            'services' => 'services',
        ];

        if (isset($named[$slug])) {
            return route($named[$slug]);
        }

        return url('/'.$slug);
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

    public function getFeaturedImageUrlAttribute(): ?string
    {
        $image = $this->featured_image ?: $this->image;

        if (! $image) {
            return null;
        }

        if (str_starts_with($image, 'http://') || str_starts_with($image, 'https://')) {
            return $image;
        }

        $relative = $image;
        if (str_starts_with($relative, '/storage/')) {
            $relative = substr($relative, strlen('/storage/'));
        } elseif (str_starts_with($relative, 'storage/')) {
            $relative = substr($relative, strlen('storage/'));
        }

        $relative = ltrim($relative, '/');
        $absolute = storage_path('app/public/'.$relative);

        if (! is_file($absolute)) {
            return null;
        }

        return asset('storage/'.$relative);
    }

    public function getOgImageAttribute(): ?string
    {
        if ($this->og_image_url) {
            return $this->og_image_url;
        }

        return $this->featured_image_url ?: asset('Image/logo.png');
    }
}
