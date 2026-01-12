@extends('layouts.main')
@section('title')
    Mini-CRM
@endsection
<!-- Offcanvas (mobile nav) -->
@section('content')
    <!-- Page -->
    <main class="container-fluid px-3 px-lg-4 py-4">
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <span class="chip"><i
                            class="bi bi-shield-lock me-2"></i>Role: {{ auth()->user()->getRole() }}</span>
                </div>
                <h1 class="h3 text-white mb-1 page-title">Dashboard</h1>
                <div class="text-muted-soft">Overview of clients, deals, tasks and
                    @can('view', auth()->user())
                        recent activity.
                    @endcan
                </div>
            </div>

            <div class="d-flex gap-2">
                <a class="btn btn-soft rounded-pill px-3" href="{{ route('deals.index') }}">
                    <i class="bi bi-arrow-right-circle me-1"></i>Go to Deals
                </a>
                <a class="btn btn-primary rounded-pill px-3" href="{{ route('clients.create') }}">
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
                            <div class="h2 text-white fw-semibold mb-0">{{ $totalClient }}</div>
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
                            <div class="text-muted-soft small">New</div>
                            <div class="h2 text-white fw-semibold mb-0">{{ $totalNewClients }}</div>
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
                            <div class="h2 text-white fw-semibold mb-0">{{ $openDeals }}</div>
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
                            <div class="text-muted-soft small">Won</div>
                            <div class="h2 text-white fw-semibold mb-0">{{ number_format($wonTotal, 0, ',', ' ') }} RUB
                            </div>
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
                            <div class="text-white fw-semibold">Tasks Today</div>
                            <div class="text-muted-soft small">Focus on the most important items.</div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-darkish table-hover align-middle mb-0">
                            <thead>
                            <tr>
                                <th>Task</th>
                                <th class="text-nowrap">Due</th>
                                <th>Priority</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($tasksToday as $task)
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">{{ $task->title }}</div>
                                        <div class="text-muted-soft small">Deal #{{ $task->deal->id }}</div>
                                    </td>
                                    <td class="text-nowrap">{{ $task->due_at }}</td>
                                    <td><span
                                            class="badge {{ $task->priority->badgeClass() }} rounded-pill">{{ $task->priority->label() }}</span>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <a class="btn btn-soft btn-sm rounded-pill px-3" href="{{ route('tasks.index') }}">
                            View all <i class="bi bi-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Activity / Logs -->

            @can('view', auth()->user())
                <div class="col-lg-5">
                    <div class="glass p-3 h-100">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <div>
                                <div class="text-white fw-semibold">Recent Activity</div>
                                <div class="text-muted-soft small">Last 10 events from audit log.</div>
                            </div>
                            <a href="{{ route('logs.index') }}" class="btn btn-soft btn-sm rounded-pill px-3">
                                <i class="bi bi-activity me-1"></i>Open Logs
                            </a>
                        </div>

                        <div class="list-group list-group-darkish">
                            @foreach ($logs as $log)
                                <div class="list-group-item px-3 py-3">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div>
                                            <div class="text-white">{{ $log->entity_type }} <span
                                                    class="fw-semibold">{{ $log->action }}</span>
                                            </div>
                                            <div class="text-muted-soft small">{{ $log->entity_type }}
                                                #{{ $log->entity_id }}
                                            </div>
                                        </div>
                                        <small
                                            class="text-muted-soft text-nowrap">{{ $log->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-3 text-muted-soft small">
                            Tip: keep activity and KPIs on dashboard; details live in <a
                                class="text-decoration-underline text-white" href="{{ route('logs.index') }}">Logs</a>.
                        </div>
                    </div>
                </div>
            @endcan
        </div>

    </main>
@endsection
