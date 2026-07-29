<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LoginHistory extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'ip',
        'agent',
    ];
}
