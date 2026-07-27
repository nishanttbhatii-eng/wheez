<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BasicSetting;
use Illuminate\Http\Request;

class SiteSettingController extends Controller
{
    public const EDITABLE_KEYS = [
        'email',
        'alternative-email',
        'ADMIN-MAIL',
        'contact_us_receiving_mail',
        'mobile',
        'mobile1',
        'address',
        'copyright',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'mail_from',
        'mail_from_name',
    ];

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (! auth()->user()?->isAdmin()) {
                abort(403, 'You are not authorized to access this area.');
            }

            return $next($request);
        });
    }

    public function index()
    {
        $settings = BasicSetting::query()
            ->whereIn('name', self::EDITABLE_KEYS)
            ->pluck('value', 'name');

        $allSettings = BasicSetting::orderBy('name')->get();

        return view('admin.site-settings.index', [
            'settings' => $settings,
            'allSettings' => $allSettings,
            'keys' => self::EDITABLE_KEYS,
        ]);
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'settings' => 'required|array',
            'settings.*' => 'nullable|string|max:2000',
        ]);

        foreach ($data['settings'] as $name => $value) {
            if (! in_array($name, self::EDITABLE_KEYS, true)) {
                continue;
            }
            BasicSetting::setValue($name, $value);
        }

        return redirect()->route('admin.site-settings.index')->with('success', 'Site settings updated successfully.');
    }
}
