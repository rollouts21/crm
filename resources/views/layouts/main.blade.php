<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    <style>
        :root {
            --app-radius: 16px;
        }

        body {
            background: #0b1220;
        }

        .app-shell {
            background:
                radial-gradient(1200px 600px at 10% 0%, rgba(99, 102, 241, .22), transparent 60%),
                radial-gradient(900px 500px at 90% 10%, rgba(56, 189, 248, .18), transparent 55%),
                linear-gradient(180deg, #0b1220 0%, #0b1220 60%, #0e172a 100%);
            min-height: 100vh;
        }

        .glass {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .10);
            backdrop-filter: blur(10px);
            border-radius: var(--app-radius);
        }

        .nav-glass {
            background: rgba(11, 18, 32, .65);
            border-bottom: 1px solid rgba(255, 255, 255, .08);
            backdrop-filter: blur(10px);
        }

        .brand-badge {
            width: 38px;
            height: 38px;
            display: grid;
            place-items: center;
            border-radius: 12px;
            background: linear-gradient(135deg, rgba(99, 102, 241, .9), rgba(56, 189, 248, .75));
            box-shadow: 0 10px 30px rgba(99, 102, 241, .25);
        }

        .page-title {
            letter-spacing: .2px;
        }

        .kpi-card {
            border-radius: var(--app-radius);
            border: 1px solid rgba(255, 255, 255, .10);
            background: rgba(255, 255, 255, .06);
            box-shadow: 0 14px 40px rgba(0, 0, 0, .25);
        }

        .kpi-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            display: grid;
            place-items: center;
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .10);
        }

        .chip {
            border-radius: 999px;
            border: 1px solid rgba(255, 255, 255, .12);
            background: rgba(255, 255, 255, .06);
            color: rgba(255, 255, 255, .85);
            padding: .35rem .65rem;
            font-size: .85rem;
        }

        .table-darkish {
            --bs-table-bg: transparent;
            --bs-table-color: rgba(255, 255, 255, .85);
            --bs-table-border-color: rgba(255, 255, 255, .08);
            --bs-table-striped-bg: rgba(255, 255, 255, .03);
            --bs-table-hover-bg: rgba(255, 255, 255, .05);
        }

        .list-group-darkish .list-group-item {
            background: transparent;
            border-color: rgba(255, 255, 255, .08);
            color: rgba(255, 255, 255, .85);
        }

        .text-muted-soft {
            color: rgba(255, 255, 255, .55) !important;
        }

        .btn-soft {
            background: rgba(255, 255, 255, .08);
            border: 1px solid rgba(255, 255, 255, .14);
            color: rgba(255, 255, 255, .9);
        }

        .btn-soft:hover {
            background: rgba(255, 255, 255, .12);
            border-color: rgba(255, 255, 255, .18);
            color: #fff;
        }

        .nav-link {
            color: rgba(255, 255, 255, .75);
            border-radius: 12px;
        }

        .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, .06);
        }

        .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, .10);
        }

        .search-input {
            background: rgba(255, 255, 255, .06);
            border: 1px solid rgba(255, 255, 255, .12);
            color: rgba(255, 255, 255, .9);
            border-radius: 14px;
        }

        .search-input::placeholder {
            color: rgba(255, 255, 255, .45);
        }

        .search-input:focus {
            background: rgba(255, 255, 255, .06);
            color: #fff;
        }

        a {
            text-decoration: none;
        }
    </style>
</head>

<body>

    <div class="app-shell">
        <!-- Header / Navbar -->
        <nav class="navbar navbar-expand-lg nav-glass sticky-top">
            <div class="container-fluid px-3 px-lg-4">
                <a class="navbar-brand d-flex align-items-center gap-2" href="/dashboard">
                    <span class="brand-badge">
                        <i class="bi bi-grid-1x2-fill text-white"></i>
                    </span>
                    <div class="d-flex flex-column lh-sm">
                        <span class="fw-semibold text-white">Mini-CRM</span>
                        <small class="text-muted-soft">Sales & Clients</small>
                    </div>
                </a>

                <!-- Mobile -->
                <button class="navbar-toggler border-0 text-white" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#navOffcanvas">
                    <i class="bi bi-list fs-2"></i>
                </button>

                <!-- Desktop -->
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav me-auto gap-1">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('clients.*') ? 'active' : '' }} px-3"
                                href="{{ route('clients.index') }}"><i class="bi bi-people me-2"></i>Clients</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('deals.*') ? 'active' : '' }} px-3"
                                href="/deals"><i class="bi bi-cash-stack me-2"></i>Deals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('tasks.*') ? 'active' : '' }} px-3"
                                href="/tasks"><i class="bi bi-check2-square me-2"></i>Tasks</a>
                        </li>
                        @can('view', auth()->user())
                            <li class="nav-item">
                                <a class="nav-link px-3 {{ request()->routeIs('logs.*') ? 'active' : '' }}"
                                    href="/logs"><i class="bi bi-activity me-2"></i>Logs</a>
                            </li>
                        @endcan
                    </ul>

                    <div class="d-flex align-items-center gap-2">
                        <div class="d-none d-md-flex align-items-center gap-2">
                            <i class="bi bi-search text-muted-soft"></i>
                            <input class="form-control form-control-sm search-input" style="width: 260px;"
                                type="search" placeholder="Search clients, deals..." />
                        </div>

                        <a href="{{ route('clients.create') }}" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="bi bi-plus-lg me-1"></i>New Client
                        </a>

                        <div class="dropdown">
                            <button class="btn btn-soft btn-sm rounded-pill px-3 dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <i class="bi bi-person-circle me-1"></i>{{ auth()->user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow">
                                <li><a class="dropdown-item" href="/profile"><i
                                            class="bi bi-person me-2"></i>Profile</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form action="{{ route('logout') }}" method="post">
                                        @csrf
                                        <button class="dropdown-item text-danger"><i
                                                class="bi bi-box-arrow-right me-2"></i>Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="navOffcanvas">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title">Navigation</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
            </div>
            <div class="offcanvas-body">
                <div class="mb-3">
                    <input class="form-control search-input" type="search" placeholder="Search..." />
                </div>

                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action bg-transparent text-white" href="/clients">
                        <i class="bi bi-people me-2"></i>Clients
                    </a>
                    <a class="list-group-item list-group-item-action bg-transparent text-white" href="/deals">
                        <i class="bi bi-cash-stack me-2"></i>Deals
                    </a>
                    <a class="list-group-item list-group-item-action bg-transparent text-white" href="/tasks">
                        <i class="bi bi-check2-square me-2"></i>Tasks
                    </a>
                    @can('view', auth()->user())
                        <a class="list-group-item list-group-item-action bg-transparent text-white" href="/logs">
                            <i class="bi bi-activity me-2"></i>Logs
                        </a>
                    @endcan
                </div>

                <div class="mt-4 d-grid gap-2">
                    <a href="/clients/create" class="btn btn-primary rounded-pill">
                        <i class="bi bi-plus-lg me-1"></i>New Client
                    </a>
                    <a href="/profile" class="btn btn-soft rounded-pill">
                        <i class="bi bi-person me-1"></i>Profile
                    </a>
                    <a href="/logout" class="btn btn-outline-danger rounded-pill">
                        <i class="bi bi-box-arrow-right me-1"></i>Logout
                    </a>
                </div>
            </div>
        </div>
        @yield('content')
    </div>


    <footer class="py-4 mt-4 text-center text-muted-soft small">
        Mini-CRM • Bootstrap UI • Dashboard
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
