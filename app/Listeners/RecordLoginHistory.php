<?php

namespace App\Listeners;

use App\Events\UserLoggedIn;
use App\Models\LoginHistory;
use Illuminate\Support\Facades\Request;

class RecordLoginHistory
{
    public function handle(UserLoggedIn $event): void
    {
        LoginHistory::create([
            'name' => $event->user->name,
            'email' => $event->user->email,
            'ip' => Request::ip(),
            'agent' => Request::header('user-agent'),
        ]);
    }
}
