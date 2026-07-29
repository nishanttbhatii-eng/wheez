<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminPanelAccess
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user?->canAccessAdminPanel()) {
            abort(403, 'You are not authorized to access this area.');
        }

        return $next($request);
    }
}
