{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}



<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-bs-theme="{{ session('theme', 'light') }}">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Pet Market - @yield('title', 'Admin Dashboard')</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
  <meta name="color-scheme" content="light dark" />
  <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
  <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
  <meta name="title" content="Pet Market - Admin Dashboard" />
  <meta name="author" content="Pet Market" />
  <meta name="description" content="Pet Market - Online platform for buying and selling animals" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Fonts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" media="print"
    onload="this.media='all'" />

  <!-- Third Party Plugins -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
    crossorigin="anonymous" />

  <!-- Main CSS -->
  {{-- @vite(['resources/css/app.css', 'resources/css/adminlte.css']) --}}
    <link rel="stylesheet" href="{{ asset('admin/assets/css/adminlte.css') }}" />

  <style>
    [data-bs-theme="dark"] {
      --bs-body-bg: #1a1a1a;
      --bs-body-color: #f8f9fa;
      --bs-secondary-bg: #2d2d2d;
      --bs-tertiary-bg: #343a40;
      --bs-border-color: #495057;
    }

    [data-bs-theme="dark"] .card {
      background-color: var(--bs-secondary-bg);
      border-color: var(--bs-border-color);
    }

    [data-bs-theme="dark"] .table {
      --bs-table-bg: var(--bs-secondary-bg);
      --bs-table-color: var(--bs-body-color);
      --bs-table-striped-bg: rgba(255, 255, 255, 0.05);
      --bs-table-hover-bg: rgba(255, 255, 255, 0.1);
    }

    [data-bs-theme="dark"] .topbar {
      background-color: var(--bs-secondary-bg);
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
      border-bottom: 1px solid var(--bs-border-color);
    }

    [data-bs-theme="dark"] .sidebar {
      background: var(--bs-tertiary-bg);
      color: var(--bs-body-color);
    }

    [data-bs-theme="dark"] .sidebar-menu .nav-link {
      color: rgba(255, 255, 255, 0.8);
    }
  </style>

  @stack('styles')
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
  <div class="app-wrapper">
    <!-- Header/Navbar -->
    @include('layouts.navigation')

    <!-- Sidebar -->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <!-- Sidebar Brand -->
      <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}" class="brand-link">
          <img src="{{ asset('admin/assets/assets/img/avatar.png') }}" alt="Pet Market Logo" class="brand-image opacity-75 shadow" />
          <span class="brand-text fw-light">Pet Market</span>
        </a>
      </div>

      <!-- Sidebar Menu -->
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation"
            aria-label="Main navigation" data-accordion="false" id="navigation">
            <!-- Dashboard -->
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <!-- Animals Management -->
            <li class="nav-item">
              <a href="#"  class="nav-link">
                <i class="nav-icon bi bi-egg-fill"></i>
                <p>
                  Animals
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item {{ request()->routeIs('animals.index') ? 'active' : '' }}">
                  <a href="{{ route('animals.index') }}"class="nav-link">
                    <i class="nav-icon bi bi-list"></i>
                    <p>All Animals</p>
                  </a>
                </li>
                <li class="nav-item {{ request()->routeIs('animals.create') ? 'active' : '' }}">
                  <a href="{{ route('animals.create') }}" class="nav-link">
                    <i class="nav-icon bi bi-plus-circle"></i>
                    <p>Add New Animal</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{ route('categories.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-tags"></i>
                    <p>Categories</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-collection"></i>
                    <p>Group Sales</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Sales Management -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-cash-stack"></i>
                <p>
                  Sales
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('orders.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-cart-check"></i>
                    <p>Orders</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-gem"></i>
                    <p>Auctions</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-graph-up"></i>
                    <p>Sales Reports</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- User Management -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-people-fill"></i>
                <p>
                  Users
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="{{ route('users.index') }}" class="nav-link">
                    <i class="nav-icon bi bi-people"></i>
                    <p>All Users</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-person-badge"></i>
                    <p>Sellers</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-person-check"></i>
                    <p>Buyers</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-shield-lock"></i>
                    <p>Admins</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Communication -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-chat-left-text"></i>
                <p>
                  Communication
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-chat-dots"></i>
                    <p>Messages</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-star-fill"></i>
                    <p>Reviews</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Reports -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-flag"></i>
                <p>
                  Reports
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-exclamation-triangle"></i>
                    <p>Issue Reports</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-activity"></i>
                    <p>Analytics</p>
                  </a>
                </li>
              </ul>
            </li>

            <!-- Settings -->
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon bi bi-gear-fill"></i>
                <p>
                  Settings
                  <i class="nav-arrow bi bi-chevron-right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-sliders"></i>
                    <p>General Settings</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-credit-card"></i>
                    <p>Payment Methods</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon bi bi-palette"></i>
                    <p>Templates</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!-- Main Content Area -->
    <main class="app-main">
      <!-- Content Header -->
      <div class="app-content-header">
        <div class="container-fluid">
          <div class="row">
            <div class="col-sm-6">
              <h3 class="mb-0">Dashboard</h3>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-end">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div>
          </div>
        </div>
      </div>

      <!-- Main Content -->
      <div class="app-content">
        {{-- <div class="container-fluid"> --}}
          {{ $slot }}
        {{-- </div> --}}
      </div>
    </main>

    <!-- Footer -->
    <footer class="app-footer">
      <div class="float-end d-none d-sm-inline">Pet Market Admin</div>
      <strong>Copyright &copy; 2025-{{ date('Y') }} <a href="#" class="text-decoration-none">Pet Market</a>.</strong> All rights
      reserved.
    </footer>
  </div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js" crossorigin="anonymous"></script>
  {{-- @vite(['resources/js/app.js', 'resources/js/adminlte.js']) --}}
  <script src="{{ asset('admin/assets/js/adminlte.js') }}" defer></script>

  <script>
    const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
    const Default = {
      scrollbarTheme: 'os-theme-light',
      scrollbarAutoHide: 'leave',
      scrollbarClickScroll: true,
    };
    document.addEventListener('DOMContentLoaded', function () {
      const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
      if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
        OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
          scrollbars: {
            theme: Default.scrollbarTheme,
            autoHide: Default.scrollbarAutoHide,
            clickScroll: Default.scrollbarClickScroll,
          },
        });
      }
    });

    // Theme toggle functionality
    document.getElementById('themeToggle').addEventListener('click', function () {
      const html = document.documentElement;
      const currentTheme = html.getAttribute('data-bs-theme');
      const darkIcon = document.getElementById('darkIcon');
      const lightIcon = document.getElementById('lightIcon');
      const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

      html.setAttribute('data-bs-theme', newTheme);
      
      // Store theme preference in session
      fetch('{{ route("theme.update") }}', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({theme: newTheme})
      });
      
      if (newTheme === 'dark') {
        lightIcon.classList.add('d-none');
        darkIcon.classList.remove('d-none');
      } else {
        darkIcon.classList.add('d-none');
        lightIcon.classList.remove('d-none');
      }
    });

    // Check for saved theme preference on load
    document.addEventListener('DOMContentLoaded', function () {
      const html = document.documentElement;
      const darkIcon = document.getElementById('darkIcon');
      const lightIcon = document.getElementById('lightIcon');

      if (html.getAttribute('data-bs-theme') === 'dark') {
        lightIcon.classList.add('d-none');
        darkIcon.classList.remove('d-none');
      } else {
        darkIcon.classList.add('d-none');
        lightIcon.classList.remove('d-none');
      }
    });
  </script>

  @stack('scripts')
  
</body>
</html>
