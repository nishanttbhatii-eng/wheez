<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogActivity;
use Illuminate\Http\Request;

class LogActivityController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! auth()->user()?->isAdmin()) {
                abort(403, 'You are not authorized to access this area.');
            }

            return $next($request);
        });
    }

    public function index(Request $request)
    {
        $query = LogActivity::with('user')->latest('id');

        if ($search = trim((string) $request->get('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('subject', 'like', "%{$search}%")
                    ->orWhere('url', 'like', "%{$search}%")
                    ->orWhere('method', 'like', "%{$search}%")
                    ->orWhere('ip', 'like', "%{$search}%");
            });
        }

        $logs = $query->paginate(20)->withQueryString();

        return view('admin.log-activities.index', compact('logs'));
    }
}
