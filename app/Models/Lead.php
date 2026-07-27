<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lead extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'state_id',
    ];

    protected $casts = [
        'state_id' => 'integer',
    ];

    public function state(): BelongsTo
    {
        return $this->belongsTo(State::class);
    }
}
