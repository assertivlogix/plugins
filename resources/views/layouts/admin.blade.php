<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Trusted WordPress Solutions') }} - Admin</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    <style>
        :root {
            --sidebar-width: 250px;
            --sidebar-bg: #4e73df;
            --sidebar-hover: #2e59d9;
            --header-bg: #fff;
            --content-bg: #f8f9fc;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Nunito', sans-serif;
            background-color: var(--content-bg);
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            color: white;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            z-index: 1000;
            transition: all 0.3s;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-header {
            padding: 1.5rem;
            background: rgba(0,0,0,0.1);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-header h3 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 700;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .sidebar-item {
            margin-bottom: 0.5rem;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            padding: 1rem 1.5rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }

        .sidebar-link:hover {
            background: var(--sidebar-hover);
            color: white;
            border-left-color: #fff;
        }

        .sidebar-link.active {
            background: var(--sidebar-hover);
            color: white;
            border-left-color: #fff;
        }

        .sidebar-link i {
            width: 20px;
            margin-right: 10px;
            text-align: center;
        }

        .sidebar.collapsed .sidebar-link span {
            display: none;
        }

        .sidebar.collapsed .sidebar-link i {
            margin-right: 0;
        }

        .main-content {
            flex: 1;
            margin-left: var(--sidebar-width);
            transition: all 0.3s;
        }

        .main-content.expanded {
            margin-left: 80px;
        }

        .top-header {
            background: var(--header-bg);
            padding: 1rem 2rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .toggle-sidebar {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #5a5c69;
        }

        .user-dropdown {
            position: relative;
        }

        .user-dropdown-toggle {
            background: none;
            border: none;
            display: flex;
            align-items: center;
            cursor: pointer;
            padding: 0.5rem 1rem;
            border-radius: 0.35rem;
            transition: background 0.3s;
        }

        .user-dropdown-toggle:hover {
            background: #f8f9fc;
        }

        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--sidebar-bg);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 0.5rem;
            font-weight: bold;
        }

        .user-dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background: white;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            min-width: 200px;
            display: none;
        }

        .user-dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            padding: 0.75rem 1rem;
            color: #5a5c69;
            text-decoration: none;
            transition: background 0.3s;
        }

        .dropdown-item:hover {
            background: #f8f9fc;
            color: var(--sidebar-bg);
        }

        .dropdown-divider {
            height: 1px;
            background: #e3e6f0;
            margin: 0.5rem 0;
        }

        .content-area {
            padding: 2rem;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            font-size: 2rem;
            font-weight: 700;
            color: #5a5c69;
            margin: 0;
        }

        .page-subtitle {
            color: #858796;
            margin: 0.5rem 0 0 0;
        }

        /* Card Styles */
        .card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 1.5rem;
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.5rem;
            font-weight: 700;
            color: #5a5c69;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Stats Cards */
        .stats-card {
            border-left: 0.25rem solid;
        }

        .stats-card.primary {
            border-left-color: #4e73df;
        }

        .stats-card.success {
            border-left-color: #1cc88a;
        }

        .stats-card.info {
            border-left-color: #36b9cc;
        }

        .stats-card.warning {
            border-left-color: #f6c23e;
        }

        .stats-card.danger {
            border-left-color: #e74a3b;
        }

        .stats-icon {
            font-size: 2rem;
            opacity: 0.3;
        }

        .stats-value {
            font-size: 1.5rem;
            font-weight: 700;
            color: #5a5c69;
        }

        .stats-label {
            font-size: 0.875rem;
            color: #858796;
            text-transform: uppercase;
            font-weight: 600;
        }

        /* Table Styles */
        .table {
            background: white;
        }

        .table th {
            border-top: none;
            font-weight: 600;
            color: #5a5c69;
            font-size: 0.875rem;
            text-transform: uppercase;
        }

        .badge {
            padding: 0.375rem 0.75rem;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* Button Styles */
        .btn {
            border-radius: 0.35rem;
            font-weight: 600;
            padding: 0.5rem 1rem;
        }

        .btn-primary {
            background: var(--sidebar-bg);
            border-color: var(--sidebar-bg);
        }

        .btn-primary:hover {
            background: var(--sidebar-hover);
            border-color: var(--sidebar-hover);
        }

        /* Form Styles */
        .form-group label {
            font-weight: 600;
            color: #5a5c69;
        }

        .form-control {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
        }

        .form-control:focus {
            border-color: var(--sidebar-bg);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        /* Alert Styles */
        .alert {
            border: none;
            border-radius: 0.35rem;
        }

        .alert-success {
            background: #d1ecf1;
            color: #0c5460;
        }

        .alert-danger {
            background: #f8d7da;
            color: #721c24;
        }

        /* Chart Styles */
        .chart-area {
            position: relative;
            height: 300px;
        }

        .chart-pie {
            position: relative;
            height: 250px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .content-area {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h3>Admin</h3>
            </div>
            <nav class="sidebar-menu">
                <div class="sidebar-item">
                    <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="{{ route('admin.licenses.index') }}" class="sidebar-link {{ request()->routeIs('admin.licenses.*') ? 'active' : '' }}">
                        <i class="fas fa-key"></i>
                        <span>Licenses</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="{{ route('admin.plugins.index') }}" class="sidebar-link {{ request()->routeIs('admin.plugins.*') ? 'active' : '' }}">
                        <i class="fas fa-plug"></i>
                        <span>Plugins</span>
                    </a>
                </div>
                <div class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="fas fa-cog"></i>
                        <span>Settings</span>
                    </a>
                </div>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content" id="mainContent">
            <!-- Top Header -->
            <header class="top-header">
                <button class="toggle-sidebar" id="toggleSidebar">
                    <i class="fas fa-bars"></i>
                </button>
                
                <div class="user-dropdown">
                    <button class="user-dropdown-toggle" id="userDropdownToggle">
                        <div class="user-avatar">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span>{{ auth()->user()->name }}</span>
                        <i class="fas fa-chevron-down ms-2"></i>
                    </button>
                    <div class="user-dropdown-menu" id="userDropdownMenu">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user fa-fw me-2"></i> Profile
                        </a>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-cog fa-fw me-2"></i> Settings
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt fa-fw me-2"></i> Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="content-area">
                @yield('content')
            </div>
        </main>
    </div>

    <script>
        // Toggle Sidebar
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        
        toggleSidebar.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            mainContent.classList.toggle('expanded');
        });

        // User Dropdown
        const userDropdownToggle = document.getElementById('userDropdownToggle');
        const userDropdownMenu = document.getElementById('userDropdownMenu');
        
        userDropdownToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdownMenu.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            userDropdownMenu.classList.remove('show');
        });

        // Prevent dropdown from closing when clicking inside
        userDropdownMenu.addEventListener('click', function(e) {
            e.stopPropagation();
        });

        // Mobile sidebar toggle
        if (window.innerWidth <= 768) {
            toggleSidebar.addEventListener('click', function() {
                sidebar.classList.toggle('show');
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>
