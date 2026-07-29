<?php

namespace App\Helpers;

use App\Models\LogActivity as LogActivityModel;
use Illuminate\Support\Facades\Request;

class LogActivity
{
    public static function addToLog(string $subject): void
    {
        LogActivityModel::create([
            'subject' => $subject,
            'url' => Request::fullUrl(),
            'method' => Request::method(),
            'ip' => Request::ip() ?? '',
            'agent' => Request::header('user-agent'),
            'user_id' => auth()->id(),
        ]);
    }
}
