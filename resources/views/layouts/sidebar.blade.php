<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ISP Ticket System')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 260px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            z-index: 1000;
            transition: all 0.3s ease;
            overflow-y: auto;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar.collapsed {
            width: 70px;
        }

        .sidebar-header {
            padding: 1.25rem 1rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.15);
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .sidebar-header::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translate(0, 0) rotate(0deg); }
            50% { transform: translate(-10px, -10px) rotate(180deg); }
        }

        .sidebar-brand {
            font-size: 1.3rem;
            font-weight: 700;
            color: white;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.65rem;
            position: relative;
            transition: all 0.3s ease;
        }

        .sidebar-brand:hover {
            transform: scale(1.03);
        }

        .sidebar-brand .brand-icon {
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid rgba(255, 255, 255, 0.3);
            flex-shrink: 0;
        }

        .sidebar-brand .brand-icon i {
            font-size: 1.1rem;
        }

        .sidebar-brand-text {
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .sidebar.collapsed .sidebar-brand-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-section-title {
            padding: 1rem 1.25rem 0.5rem;
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.6);
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .nav-section-title {
            opacity: 0;
            height: 0;
            padding: 0;
            overflow: hidden;
        }

        .nav-item {
            margin: 0.15rem 0.75rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            border-radius: 10px;
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 3px;
            background: white;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            transform: translateX(3px);
        }

        .nav-link:hover::before {
            transform: scaleY(1);
        }

        .nav-link.active {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .nav-link.active::before {
            transform: scaleY(1);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
            margin-right: 0.75rem;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .nav-link-text {
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .sidebar.collapsed .nav-link-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar.collapsed .nav-link {
            justify-content: center;
        }

        .sidebar.collapsed .nav-link i {
            margin-right: 0;
        }

        /* Admin Section Separator */
        .nav-separator {
            margin: 1.5rem 1.25rem 0.75rem;
            border-top: 2px solid rgba(255, 255, 255, 0.2);
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .nav-separator {
            margin: 1rem 1rem 0.5rem;
        }

        /* Sidebar Footer */
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 1rem;
            border-top: 2px solid rgba(255, 255, 255, 0.15);
            background: rgba(0, 0, 0, 0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
            padding: 0.5rem;
            border-radius: 10px;
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.25);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 700;
            border: 2px solid rgba(255, 255, 255, 0.3);
            flex-shrink: 0;
        }

        .user-details {
            flex: 1;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .user-name {
            font-weight: 600;
            font-size: 0.85rem;
            margin-bottom: 0.15rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .user-role {
            font-size: 0.7rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .sidebar.collapsed .user-details {
            opacity: 0;
            width: 0;
        }

        .sidebar.collapsed .user-info {
            justify-content: center;
        }

        .logout-btn {
            width: 100%;
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.25);
            color: white;
            padding: 0.65rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            font-weight: 600;
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            text-decoration: none;
        }

        .logout-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .logout-btn i {
            font-size: 1rem;
        }

        .logout-btn-text {
            transition: all 0.3s ease;
        }

        .sidebar.collapsed .logout-btn-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 70px;
        }

        .top-navbar {
            background: white;
            border-bottom: 1px solid #e2e8f0;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .sidebar-toggle {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            color: white;
            font-size: 1.1rem;
            cursor: pointer;
            padding: 0.6rem 0.75rem;
            border-radius: 10px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
        }

        .sidebar-toggle:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        }

        .navbar-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .date-badge {
            background: linear-gradient(135deg, #f5f7fa 0%, #e2e8f0 100%);
            padding: 0.5rem 1rem;
            border-radius: 10px;
            color: #4a5568;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .date-badge i {
            color: #667eea;
        }

        .content-area {
            padding: 1.5rem;
        }

        /* Mobile Responsive */
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

            .main-content.expanded {
                margin-left: 0;
            }

            .content-area {
                padding: 1rem;
            }

            .date-badge {
                font-size: 0.75rem;
                padding: 0.4rem 0.75rem;
            }
        }

        /* Overlay for mobile */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .sidebar-overlay.show {
            display: block;
            opacity: 1;
        }
    </style>
    @yield('styles')
</head>
<body>
    <!-- Sidebar Overlay (Mobile) -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('home') }}" class="sidebar-brand">
                <div class="brand-icon">
                    <i class="fas fa-ticket-alt"></i>
                </div>
                <span class="sidebar-brand-text">ISP Ticket</span>
            </a>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-title">Menu Utama</div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('tickets.*') ? 'active' : '' }}" href="{{ route('tickets.index') }}">
                        <i class="fas fa-ticket-alt"></i>
                        <span class="nav-link-text">Tiket</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                        <i class="fas fa-users"></i>
                        <span class="nav-link-text">Pelanggan</span>
                    </a>
                </li>

                @if(auth()->user()->role === 'admin')
                <div class="nav-separator"></div>
                <div class="nav-section-title">Administrator</div>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="fas fa-user-shield"></i>
                        <span class="nav-link-text">Kelola Users</span>
                    </a>
                </li>
                @endif
            </ul>
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">
                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                </div>
                <div class="user-details">
                    <div class="user-name">{{ auth()->user()->name ?? 'User' }}</div>
                    <div class="user-role">{{ auth()->user()->role ?? 'Admin' }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    <i class="fas fa-sign-out-alt"></i>
                    <span class="logout-btn-text">Logout</span>
                </button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Navbar -->
        <div class="top-navbar">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="navbar-info">
                <div class="date-badge">
                    <i class="fas fa-calendar-alt"></i>
                    <span>{{ date('d F Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const sidebarToggle = document.getElementById('sidebarToggle');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        // Desktop Toggle
        sidebarToggle.addEventListener('click', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            } else {
                // Mobile Toggle
                sidebar.classList.toggle('show');
                sidebarOverlay.classList.toggle('show');
            }
        });

        // Close sidebar when clicking overlay
        sidebarOverlay.addEventListener('click', function() {
            sidebar.classList.remove('show');
            sidebarOverlay.classList.remove('show');
        });

        // Handle window resize
        window.addEventListener('resize', function() {
            if (window.innerWidth > 768) {
                sidebar.classList.remove('show');
                sidebarOverlay.classList.remove('show');
            }
        });
    </script>
    @yield('scripts')
</body>
</html>
