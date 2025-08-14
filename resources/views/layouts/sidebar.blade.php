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
                <li class="nav-item {{ 
                    request()->routeIs('animals.*') || 
                    request()->routeIs('categories.*') ? 'menu-open' : '' 
                }}">
                    <a href="#" class="nav-link {{ 
                        request()->routeIs('animals.*') || 
                        request()->routeIs('categories.*') ? 'active' : '' 
                    }}">
                        <i class="nav-icon bi bi-egg-fill"></i>
                        <p>
                            Animals
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('animals.index') }}" class="nav-link {{ 
                                request()->routeIs('animals.index') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-list"></i>
                                <p>All Animals</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('animals.create') }}" class="nav-link {{ 
                                request()->routeIs('animals.create') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-plus-circle"></i>
                                <p>Add New Animal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link {{ 
                                request()->routeIs('categories.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-tags"></i>
                                <p>Categories</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('group-sales.index') }}" class="nav-link">
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
                            <a href="{{ route('orders.index') }}" class="nav-link {{ 
                                request()->routeIs('orders.index') ? 'active' : '' 
                            }}">
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
                <li class="nav-item {{ 
                    request()->routeIs('users.*') || 
                    request()->routeIs('seller.users.*') || 
                    request()->routeIs('buyer.users.*') || 
                    request()->routeIs('admin.users.*') ? 'menu-open' : '' 
                }}">
                    <a href="#" class="nav-link {{ 
                        request()->routeIs('users.*') || 
                        request()->routeIs('seller.users.*') || 
                        request()->routeIs('buyer.users.*') || 
                        request()->routeIs('admin.users.*') ? 'active' : '' 
                    }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                            Users
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ 
                                request()->routeIs('users.index') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-people"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('sellers.index') }}" class="nav-link {{ 
                                request()->routeIs('sellers.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p>Sellers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('buyers.index') }}" class="nav-link {{ 
                                request()->routeIs('buyers.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-person-check"></i>
                                <p>Buyers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ 
                                request()->routeIs('admin.users.*') ? 'active' : '' 
                            }}">
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
























{{-- <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
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
                <li class="nav-item {{ 
                    request()->routeIs('animals.*') || 
                    request()->routeIs('categories.*') ? 'menu-open' : '' 
                }}">
                    <a href="#" class="nav-link {{ 
                        request()->routeIs('animals.*') || 
                        request()->routeIs('categories.*') ? 'active' : '' 
                    }}">
                        <i class="nav-icon bi bi-egg-fill"></i>
                        <p>
                            Animals
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('animals.index') }}" class="nav-link {{ 
                                request()->routeIs('animals.index') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-list"></i>
                                <p>All Animals</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('animals.create') }}" class="nav-link {{ 
                                request()->routeIs('animals.create') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-plus-circle"></i>
                                <p>Add New Animal</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('categories.index') }}" class="nav-link {{ 
                                request()->routeIs('categories.*') ? 'active' : '' 
                            }}">
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
                <li class="nav-item {{ 
                    request()->routeIs('orders.*') || 
                    request()->routeIs('auctions.*') ? 'menu-open' : '' 
                }}">
                    <a href="#" class="nav-link {{ 
                        request()->routeIs('orders.*') || 
                        request()->routeIs('auctions.*') ? 'active' : '' 
                    }}">
                        <i class="nav-icon bi bi-cash-stack"></i>
                        <p>
                            Sales
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('orders.index') }}" class="nav-link {{ 
                                request()->routeIs('orders.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-cart-check"></i>
                                <p>Orders</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ 
                                request()->routeIs('auctions.*') ? 'active' : '' 
                            }}">
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
                <li class="nav-item {{ 
                    request()->routeIs('users.*') || 
                    request()->routeIs('seller.users.*') || 
                    request()->routeIs('buyer.users.*') || 
                    request()->routeIs('admin.users.*') ? 'menu-open' : '' 
                }}">
                    <a href="#" class="nav-link {{ 
                        request()->routeIs('users.*') || 
                        request()->routeIs('seller.users.*') || 
                        request()->routeIs('buyer.users.*') || 
                        request()->routeIs('admin.users.*') ? 'active' : '' 
                    }}">
                        <i class="nav-icon bi bi-people-fill"></i>
                        <p>
                            Users
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link {{ 
                                request()->routeIs('users.index') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-people"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('seller.users.index') }}" class="nav-link {{ 
                                request()->routeIs('seller.users.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-person-badge"></i>
                                <p>Sellers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('buyer.users.index') }}" class="nav-link {{ 
                                request()->routeIs('buyer.users.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-person-check"></i>
                                <p>Buyers</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ 
                                request()->routeIs('admin.users.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-shield-lock"></i>
                                <p>Admins</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Communication -->
                <li class="nav-item {{ 
                    request()->routeIs('messages.*') || 
                    request()->routeIs('reviews.*') ? 'menu-open' : '' 
                }}">
                    <a href="#" class="nav-link {{ 
                        request()->routeIs('messages.*') || 
                        request()->routeIs('reviews.*') ? 'active' : '' 
                    }}">
                        <i class="nav-icon bi bi-chat-left-text"></i>
                        <p>
                            Communication
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ 
                                request()->routeIs('messages.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-chat-dots"></i>
                                <p>Messages</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ 
                                request()->routeIs('reviews.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-star-fill"></i>
                                <p>Reviews</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Reports -->
                <li class="nav-item {{ 
                    request()->routeIs('reports.*') || 
                    request()->routeIs('analytics.*') ? 'menu-open' : '' 
                }}">
                    <a href="#" class="nav-link {{ 
                        request()->routeIs('reports.*') || 
                        request()->routeIs('analytics.*') ? 'active' : '' 
                    }}">
                        <i class="nav-icon bi bi-flag"></i>
                        <p>
                            Reports
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ 
                                request()->routeIs('reports.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-exclamation-triangle"></i>
                                <p>Issue Reports</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ 
                                request()->routeIs('analytics.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-activity"></i>
                                <p>Analytics</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Settings -->
                <li class="nav-item {{ 
                    request()->routeIs('settings.*') || 
                    request()->routeIs('payment.*') || 
                    request()->routeIs('templates.*') ? 'menu-open' : '' 
                }}">
                    <a href="#" class="nav-link {{ 
                        request()->routeIs('settings.*') || 
                        request()->routeIs('payment.*') || 
                        request()->routeIs('templates.*') ? 'active' : '' 
                    }}">
                        <i class="nav-icon bi bi-gear-fill"></i>
                        <p>
                            Settings
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ 
                                request()->routeIs('settings.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-sliders"></i>
                                <p>General Settings</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ 
                                request()->routeIs('payment.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-credit-card"></i>
                                <p>Payment Methods</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link {{ 
                                request()->routeIs('templates.*') ? 'active' : '' 
                            }}">
                                <i class="nav-icon bi bi-palette"></i>
                                <p>Templates</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside> --}}