<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Logistic') }} - @yield('title', 'Dashboard')</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        .card-shadow {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        .btn-primary {
            background: linear-gradient(45deg, #667eea, #764ba2);
            border: none;
        }
        .btn-primary:hover {
            background: linear-gradient(45deg, #5a6fd8, #6a3d91);
            transform: translateY(-1px);
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        
        /* Sidebar Styles */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #2c3e50 0%, #34495e 100%);
            color: white;
            position: fixed;
            top: 0;
            left: -250px;
            width: 250px;
            transition: all 0.3s ease;
            z-index: 1050;
            overflow-y: auto;
        }
        
        .sidebar.show {
            left: 0;
        }
        
        .sidebar-header {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .sidebar-menu li {
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        
        .sidebar-menu a {
            display: block;
            padding: 15px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .sidebar-menu a:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            padding-left: 30px;
        }
        
        .sidebar-menu a.active {
            background: linear-gradient(45deg, #667eea, #764ba2);
            color: white;
        }
        
        .sidebar-menu i {
            width: 20px;
            margin-right: 10px;
        }
        
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1040;
            display: none;
        }
        
        .sidebar-overlay.show {
            display: block;
        }
        
        .main-content {
            transition: margin-left 0.3s ease;
        }
        
        .sidebar-toggle {
            background: none;
            border: none;
            color: white;
            font-size: 1.2rem;
            padding: 8px 12px;
            border-radius: 4px;
            transition: background 0.3s ease;
        }
        
        .sidebar-toggle:hover {
            background: rgba(255, 255, 255, 0.1);
        }
        
        .user-badge {
            display: inline-block;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 0.75rem;
            font-weight: bold;
            margin-left: 8px;
        }
        
        .user-badge.admin { background: #e74c3c; }
        .user-badge.company { background: #3498db; }
        .user-badge.driver { background: #27ae60; }
        
        @media (min-width: 768px) {
            .sidebar {
                position: relative;
                left: 0;
            }
            
            .main-content {
                margin-left: 250px;
            }
            
            .sidebar-overlay {
                display: none !important;
            }
        }
    </style>

    @stack('styles')
</head>
<body class="bg-light">
    @auth
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <h5 class="mb-1">
                    <i class="bi bi-truck"></i>
                     Logistic
                </h5>
                <small class="text-muted">{{ Auth::user()->name }}</small>
                <span class="user-badge {{ Auth::user()->user_type }}">
                    {{ ucfirst(Auth::user()->user_type) }}
                </span>
            </div>
            
            <ul class="sidebar-menu">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                
                @if(auth()->user()->user_type === 'admin')
                    <li>
                        <a href="{{ route('admin.logistics-load.index') }}" class="{{ request()->routeIs('admin.logistics-load.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i>
                            Manage Loads
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.drivers') }}" class="{{ request()->routeIs('admin.drivers') ? 'active' : '' }}">
                            <i class="bi bi-people"></i>
                            View Drivers
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.companies') }}" class="{{ request()->routeIs('admin.companies') ? 'active' : '' }}">
                            <i class="bi bi-building"></i>
                            View Companies
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('load-bids.index') }}" class="{{ request()->routeIs('load-bids.*') ? 'active' : '' }}">
                            <i class="bi bi-currency-dollar"></i>
                            Load Bids
                        </a>
                    </li>
                @elseif(auth()->user()->user_type === 'company')
                    <li>
                        <a href="{{ route('company.logistics-load.index') }}" class="{{ request()->routeIs('company.logistics-load.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i>
                            My Loads
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('load-bids.index') }}" class="{{ request()->routeIs('load-bids.*') ? 'active' : '' }}">
                            <i class="bi bi-currency-dollar"></i>
                            Load Bids
                        </a>
                    </li>
                @elseif(auth()->user()->user_type === 'driver')
                    <li>
                        <a href="{{ route('driver.logistics-load.index') }}" class="{{ request()->routeIs('driver.logistics-load.*') ? 'active' : '' }}">
                            <i class="bi bi-box-seam"></i>
                            Available Loads
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('driver.logistics-load.index', ['status' => 'assigned', 'driver' => 'me']) }}" class="{{ request()->input('status') === 'assigned' ? 'active' : '' }}">
                            <i class="bi bi-clipboard-check"></i>
                            Assigned Loads
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('driver.logistics-load.index', ['status' => 'completed', 'driver' => 'me']) }}" class="{{ request()->input('status') === 'completed' ? 'active' : '' }}">
                            <i class="bi bi-check-circle"></i>
                            Completed Loads
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('driver.logistics-load.create') }}" class="{{ request()->routeIs('driver.logistics-load.create') ? 'active' : '' }}">
                            <i class="bi bi-plus-circle"></i>
                            Create Load
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('load-bids.index') }}" class="{{ request()->routeIs('load-bids.*') ? 'active' : '' }}">
                            <i class="bi bi-currency-dollar"></i>
                            Load Bids
                        </a>
                    </li>
                @endif
                
                <li style="margin-top: 20px; border-top: 1px solid rgba(255,255,255,0.1); padding-top: 10px;">
                    <form action="{{ route('logout') }}" method="POST" style="margin: 0;">
                        @csrf
                        <button type="submit" style="background: none; border: none; width: 100%; text-align: left; padding: 15px 20px; color: rgba(255, 255, 255, 0.8); transition: all 0.3s ease;" onmouseover="this.style.background='rgba(231, 76, 60, 0.2)'; this.style.color='#e74c3c'; this.style.paddingLeft='30px';" onmouseout="this.style.background='none'; this.style.color='rgba(255, 255, 255, 0.8)'; this.style.paddingLeft='20px';">
                            <i class="bi bi-box-arrow-right"></i>
                            Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        
        <!-- Sidebar Overlay for mobile -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>
    @endauth

    <!-- Top Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark gradient-bg">
        <div class="container-fluid">
            @auth
                <button class="sidebar-toggle d-md-none" id="sidebarToggle">
                    <i class="bi bi-list"></i>
                </button>
            @endauth
            
            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="bi bi-truck"></i>
                Logistic
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle"></i>
                                {{ Auth::user()->name }}
                                <span class="badge bg-light text-dark ms-1">{{ ucfirst(Auth::user()->user_type) }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebarToggle = document.getElementById('sidebarToggle');
            const sidebar = document.getElementById('sidebar');
            const sidebarOverlay = document.getElementById('sidebarOverlay');
            
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                    sidebarOverlay.classList.toggle('show');
                });
            }
            
            if (sidebarOverlay) {
                sidebarOverlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                });
            }
            
            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 768) {
                    if (!sidebar.contains(e.target) && !sidebarToggle.contains(e.target)) {
                        sidebar.classList.remove('show');
                        sidebarOverlay.classList.remove('show');
                    }
                }
            });
            
            // Handle window resize
            window.addEventListener('resize', function() {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('show');
                    sidebarOverlay.classList.remove('show');
                }
            });
        });
    </script>
    
    @stack('scripts')
</body>
</html>
