<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    protected $table = 'media';

    protected $fillable = [
        'title',
        'alt_text',
        'file_name',
        'path',
        'disk',
        'mime_type',
        'size',
        'width',
        'height',
        'user_id',
    ];

    protected $casts = [
        'size' => 'integer',
        'width' => 'integer',
        'height' => 'integer',
    ];

    protected $appends = [
        'url',
        'human_size',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getUrlAttribute(): string
    {
        return asset('storage/' . ltrim($this->path, '/'));
    }

    public function getHumanSizeAttribute(): string
    {
        $bytes = (int) $this->size;
        if ($bytes < 1024) {
            return $bytes . ' B';
        }
        if ($bytes < 1048576) {
            return round($bytes / 1024, 1) . ' KB';
        }

        return round($bytes / 1048576, 2) . ' MB';
    }

    public function deleteFile(): void
    {
        if ($this->path && Storage::disk($this->disk ?: 'public')->exists($this->path)) {
            Storage::disk($this->disk ?: 'public')->delete($this->path);
        }
    }
}
