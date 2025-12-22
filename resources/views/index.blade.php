@extends('layouts.main')
@section('title')
    Mini-CRM
@endsection
<!-- Offcanvas (mobile nav) -->
@section('content')
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
                <a class="list-group-item list-group-item-action bg-transparent text-white" href="/logs">
                    <i class="bi bi-activity me-2"></i>Logs
                </a>
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

    <!-- Page -->
    <main class="container-fluid px-3 px-lg-4 py-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="chip"><i class="bi bi-calendar3 me-2"></i>Today</span>
                    <span class="chip"><i class="bi bi-shield-lock me-2"></i>Role: Admin</span>
                </div>
                <h1 class="h3 text-white mb-1 page-title">Dashboard</h1>
                <div class="text-muted-soft">Overview of clients, deals, tasks and recent activity.</div>
            </div>

            <div class="d-flex gap-2">
                <a class="btn btn-soft rounded-pill px-3" href="/deals">
                    <i class="bi bi-arrow-right-circle me-1"></i>Go to Deals
                </a>
                <a class="btn btn-primary rounded-pill px-3" href="/clients/create">
                    <i class="bi bi-plus-lg me-1"></i>Create Client
                </a>
            </div>
        </div>

        <!-- KPI -->
        <div class="row g-3 mb-4">
            <div class="col-md-6 col-xl-3">
                <div class="kpi-card p-3 h-100">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="text-muted-soft small">Total Clients</div>
                            <div class="h2 text-white fw-semibold mb-0">124</div>
                            <div class="text-muted-soft small mt-1"><i class="bi bi-arrow-up-short"></i> +8 this
                                week</div>
                        </div>
                        <div class="kpi-icon">
                            <i class="bi bi-people text-white fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="kpi-card p-3 h-100">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="text-muted-soft small">New (7 days)</div>
                            <div class="h2 text-white fw-semibold mb-0">18</div>
                            <div class="text-muted-soft small mt-1">from 3 sources</div>
                        </div>
                        <div class="kpi-icon">
                            <i class="bi bi-person-plus text-white fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="kpi-card p-3 h-100">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="text-muted-soft small">Open Deals</div>
                            <div class="h2 text-white fw-semibold mb-0">32</div>
                            <div class="text-muted-soft small mt-1">in progress</div>
                        </div>
                        <div class="kpi-icon">
                            <i class="bi bi-cash-stack text-white fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="kpi-card p-3 h-100">
                    <div class="d-flex align-items-start justify-content-between">
                        <div>
                            <div class="text-muted-soft small">Won (30 days)</div>
                            <div class="h2 text-white fw-semibold mb-0">€14,250</div>
                            <div class="text-muted-soft small mt-1">+12% vs prev.</div>
                        </div>
                        <div class="kpi-icon">
                            <i class="bi bi-trophy text-white fs-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main cards -->
        <div class="row g-3">
            <!-- Tasks -->
            <div class="col-lg-7">
                <div class="glass p-3">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div class="text-white fw-semibold">My Tasks Today</div>
                            <div class="text-muted-soft small">Focus on the most important items.</div>
                        </div>
                        <a href="/tasks/create" class="btn btn-soft btn-sm rounded-pill px-3">
                            <i class="bi bi-plus-lg me-1"></i>Add Task
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-darkish table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Task</th>
                                    <th class="text-nowrap">Due</th>
                                    <th>Priority</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">Call client “Coffee House”</div>
                                        <div class="text-muted-soft small">Client: Coffee House</div>
                                    </td>
                                    <td class="text-nowrap">12:00</td>
                                    <td><span class="badge text-bg-danger rounded-pill">High</span></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            <i class="bi bi-check2 me-1"></i>Done
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">Prepare offer</div>
                                        <div class="text-muted-soft small">Deal: Website for Bakery</div>
                                    </td>
                                    <td class="text-nowrap">16:00</td>
                                    <td><span class="badge text-bg-warning rounded-pill">Normal</span></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            <i class="bi bi-check2 me-1"></i>Done
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">Send invoice</div>
                                        <div class="text-muted-soft small">Deal: Landing page</div>
                                    </td>
                                    <td class="text-nowrap">18:30</td>
                                    <td><span class="badge text-bg-secondary rounded-pill">Low</span></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-success rounded-pill px-3">
                                            <i class="bi bi-check2 me-1"></i>Done
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <div class="text-muted-soft small">
                            <i class="bi bi-info-circle me-1"></i>Showing 3 of 7 tasks
                        </div>
                        <a class="btn btn-soft btn-sm rounded-pill px-3" href="/tasks">
                            View all <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Activity / Logs -->
            <div class="col-lg-5">
                <div class="glass p-3 h-100">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div class="text-white fw-semibold">Recent Activity</div>
                            <div class="text-muted-soft small">Last 10 events from audit log.</div>
                        </div>
                        <a href="/logs" class="btn btn-soft btn-sm rounded-pill px-3">
                            <i class="bi bi-activity me-1"></i>Open Logs
                        </a>
                    </div>

                    <div class="list-group list-group-darkish">
                        <div class="list-group-item px-0 py-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-white">
                                        Deal <span class="fw-semibold">Website for Bakery</span> marked as
                                        <span class="badge text-bg-success rounded-pill">WON</span>
                                    </div>
                                    <div class="text-muted-soft small">by Admin • Deal #152</div>
                                </div>
                                <small class="text-muted-soft text-nowrap">10m ago</small>
                            </div>
                        </div>

                        <div class="list-group-item px-0 py-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-white">New client <span class="fw-semibold">John Smith</span>
                                        created</div>
                                    <div class="text-muted-soft small">source: Instagram • Client #88</div>
                                </div>
                                <small class="text-muted-soft text-nowrap">1h ago</small>
                            </div>
                        </div>

                        <div class="list-group-item px-0 py-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-white">Task <span class="fw-semibold">Call supplier</span>
                                        completed</div>
                                    <div class="text-muted-soft small">Task #403</div>
                                </div>
                                <small class="text-muted-soft text-nowrap">Today</small>
                            </div>
                        </div>
                    </div>

                    <div class="mt-3 text-muted-soft small">
                        Tip: keep activity and KPIs on dashboard; details live in <a
                            class="text-decoration-underline text-white" href="/logs">Logs</a>.
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
