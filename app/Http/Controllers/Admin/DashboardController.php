<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Enquiry;
use App\Models\Lead;
use App\Models\Seo;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $isSuperAdmin = $user->isAdmin();

        $stats = [
            'total_users' => $isSuperAdmin ? User::staff()->count() : 0,
            'active_users' => $isSuperAdmin ? User::staff()->where('status', 'active')->count() : 0,
            'inactive_users' => $isSuperAdmin ? User::staff()->where('status', 'inactive')->count() : 0,
            'categories' => $isSuperAdmin ? Category::count() : 0,
            'services' => $isSuperAdmin ? Service::count() : 0,
            'enquiries' => $isSuperAdmin ? Enquiry::count() : 0,
            'new_enquiries' => $isSuperAdmin ? Enquiry::where('status', Enquiry::STATUS_NEW)->count() : 0,
            'leads' => $isSuperAdmin ? Lead::count() : 0,
            'seos' => $isSuperAdmin ? Seo::count() : 0,
        ];

        $charts = [
            'staff_roles' => $isSuperAdmin ? $this->staffRoleChart() : null,
            'user_status' => $isSuperAdmin ? $this->userStatusChart() : null,
        ];

        $modules = $isSuperAdmin
            ? [
                ['name' => 'Categories', 'route' => 'admin.categories.index', 'desc' => 'Service categories and subcategories'],
                ['name' => 'Services', 'route' => 'admin.services.index', 'desc' => 'Full service catalog and pricing'],
                ['name' => 'Enquiries', 'route' => 'admin.enquiries.index', 'desc' => 'Contact form leads and requests'],
                ['name' => 'Leads', 'route' => 'admin.leads.index', 'desc' => 'Campaign and form lead captures'],
                ['name' => 'SEO', 'route' => 'admin.seos.index', 'desc' => 'Meta titles and descriptions'],
                ['name' => 'Site Settings', 'route' => 'admin.site-settings.index', 'desc' => 'Email, phone, social, copyright'],
                ['name' => 'Pages', 'route' => 'admin.pages.index', 'desc' => 'Manage website pages and SEO'],
                ['name' => 'Media', 'route' => 'admin.media.index', 'desc' => 'Upload images and copy URLs'],
                ['name' => 'Users', 'route' => 'admin.staff.index', 'desc' => 'Add and manage users'],
            ]
            : [];

        return view('admin.dashboard', compact('user', 'stats', 'charts', 'modules', 'isSuperAdmin'));
    }

    private function staffRoleChart(): array
    {
        $roles = User::staff()
            ->where('status', 'active')
            ->select('role', DB::raw('count(*) as total'))
            ->groupBy('role')
            ->pluck('total', 'role');

        return [
            'labels' => $roles->keys()->map(fn ($r) => config("staff.roles.{$r}.label", ucfirst($r)))->values()->all(),
            'values' => $roles->values()->all(),
        ];
    }

    private function userStatusChart(): array
    {
        $active = User::staff()->where('status', 'active')->count();
        $inactive = User::staff()->where('status', 'inactive')->count();

        return [
            'labels' => ['Active', 'Inactive'],
            'values' => [$active, $inactive],
        ];
    }
}
