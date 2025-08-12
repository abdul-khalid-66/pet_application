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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"/>

  <!-- Third Party Plugins -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"/>
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

  @stack('css')
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-open bg-body-tertiary">
  <div class="app-wrapper">
    <!-- Header/Navbar -->
    @include('layouts.navigation')
    <!-- Sidebar -->
    @include('layouts.sidebar')

    <!-- Main Content Area -->
    <main class="app-main">

      <!-- Main Content -->
      <div class="app-content">
            <div class="card my-2">
              <div class="card-header">
                  <div class="card-title">
                    @isset($page_title)
                      <h3 class="mb-0">{{ $page_title }}</h3>
                    @endisset
                  </div>
                  <div class="card-tools">
                      @isset($page_button)
                        <h3 class="mb-0">{{ $page_button }}</h3>
                      @endisset
                  </div>
              </div>
          </div>
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
  <script src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.js"></script>
  <script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
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
  <script>
      $(function () {
          $('.jquery_datatable_class').DataTable({
              "paging": true,
              "lengthChange": true,
              "searching": true,
              "ordering": true,
              "info": true,
              "autoWidth": false,
              "responsive": true,
              "order": [[0, 'desc']],
              "columnDefs": [
                  { "orderable": false, "targets": [1, 6] },
                  { "searchable": false, "targets": [1, 6] }
              ],
              language: {
                  lengthMenu: "_MENU_", // Removes "Show entries" text
                  search: ""            // Removes "Search:" label
              },
              initComplete: function () {
                  $('.dataTables_filter input').attr('placeholder', 'Search...');
              }
          });
      });
  </script>

  @stack('scripts')
  
</body>
</html>
