<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard') - WhizSeed</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand-link">
                <div class="sidebar-logo-icon-wrap">
                    <img src="{{ asset('Image/logo.png') }}" alt="WhizSeed Logo" class="sidebar-logo">
                </div>
                <div class="sidebar-brand-name">WHIZSEED.COM</div>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span>Dashboard</span>
                </a>
            </li>
            @if(auth()->user()->isAdmin())
            <li>
                <a href="{{ route('admin.pages.index') }}" class="{{ request()->is('admin/pages*') ? 'active' : '' }}">
                    <span>Pages</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.media.index') }}" class="{{ request()->is('admin/media*') ? 'active' : '' }}">
                    <span>Media</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.menus.index') }}" class="{{ request()->is('admin/menus*') ? 'active' : '' }}">
                    <span>Menus</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <span>Categories</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.services.index') }}" class="{{ request()->is('admin/services-catalog*') ? 'active' : '' }}">
                    <span>Services</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.enquiries.index') }}" class="{{ request()->is('admin/enquiries*') ? 'active' : '' }}">
                    <span>Enquiries</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.leads.index') }}" class="{{ request()->is('admin/leads*') ? 'active' : '' }}">
                    <span>Leads</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.seos.index') }}" class="{{ request()->is('admin/seos*') ? 'active' : '' }}">
                    <span>SEO</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.site-settings.index') }}" class="{{ request()->is('admin/site-settings*') ? 'active' : '' }}">
                    <span>Site Settings</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.states.index') }}" class="{{ request()->is('admin/states*') ? 'active' : '' }}">
                    <span>States</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.staff.index') }}" class="{{ request()->is('admin/staff*') ? 'active' : '' }}">
                    <span>Users</span>
                </a>
            </li>
            @endif
        </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Header -->
        <header class="top-header">
            <div class="page-title-section">
                <button class="btn sidebar-toggle-btn d-md-none" id="sidebarToggle">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <button class="btn sidebar-toggle-btn d-none d-md-block" id="sidebarToggleDesktop">
                    <i class="fas fa-bars fa-lg"></i>
                </button>
                <h2>@yield('page-title', 'Dashboard')</h2>
            </div>
            <div class="top-header-right">
                <div class="user-menu">
                <div class="user-info" id="userDropdownToggle">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="User Avatar" class="user-avatar">
                    @else
                        <div class="user-avatar user-avatar-placeholder">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="user-details">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-email">{{ Auth::user()->email }}</div>
                    </div>
                    <i class="fas fa-chevron-down chevron-icon"></i>
                    
                    <!-- User Dropdown Menu -->
                    <div class="user-dropdown" id="userDropdownMenu">
                        <a href="{{ route('admin.profile') }}">
                            <i class="fas fa-user"></i>
                            <span>Profile</span>
                        </a>
                        <a href="{{ route('admin.settings') }}">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                        </a>
                        <div class="user-dropdown-divider"></div>
                        <button onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Logout</span>
                        </button>
                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            </div>
        </header>

        <!-- Content Wrapper -->
        <div class="content-wrapper">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- jQuery (required for DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <!-- CKEditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Sidebar toggle functionality
        $(document).ready(function() {
            // Mobile sidebar toggle
            $('#sidebarToggle').on('click', function() {
                $('.sidebar').toggleClass('active');
            });

            // Desktop sidebar toggle (collapse/expand)
            $('#sidebarToggleDesktop').on('click', function() {
                $('.sidebar').toggleClass('collapsed');
            });

            // Close sidebar when clicking outside on mobile
            $(document).on('click', function(e) {
                if ($(window).width() < 768) {
                    if (!$(e.target).closest('.sidebar, #sidebarToggle').length) {
                        $('.sidebar').removeClass('active');
                    }
                }
            });
        });
    </script>

    <script>
        // Toggle user dropdown menu
        document.getElementById('userDropdownToggle').addEventListener('click', function() {
            const dropdown = document.getElementById('userDropdownMenu');
            dropdown.classList.toggle('active');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            const userDropdown = document.getElementById('userDropdownToggle');
            const userDropdownMenu = document.getElementById('userDropdownMenu');
            if (!userDropdown.contains(event.target)) {
                userDropdownMenu.classList.remove('active');
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
