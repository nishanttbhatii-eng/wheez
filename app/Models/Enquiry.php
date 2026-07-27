<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'state_id',
        'service_slug',
        'subject',
        'description',
        'status',
    ];

    protected $casts = [
        'status' => 'integer',
        'state_id' => 'integer',
    ];

    public const STATUS_NEW = 1;
    public const STATUS_IN_PROGRESS = 2;
    public const STATUS_CLOSED = 3;

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }

    public function statusLabel(): string
    {
        return match ((int) $this->status) {
            self::STATUS_IN_PROGRESS => 'In Progress',
            self::STATUS_CLOSED => 'Closed',
            default => 'New',
        };
    }
}
