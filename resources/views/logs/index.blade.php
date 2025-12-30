@extends('layouts.main')
@section('title')
    Logs
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <!-- Page header -->
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 text-white mb-1">Activity Log</h1>
                <div class="text-muted-soft">Audit trail of all changes in the system</div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <span class="chip">
                    <i class="bi bi-shield-check me-2"></i>Audit enabled
                </span>
                <span class="chip">
                    <i class="bi bi-database-up me-2"></i>Stored for 90 days
                </span>
            </div>
        </div>

        <!-- Filters -->
        <div class="glass p-3 mb-4">
            <form class="row g-2 align-items-end" method="GET" action="/logs">

                <div class="col-md-3">
                    <label class="form-label text-muted-soft small">Search</label>
                    <input type="text" name="search" class="form-control search-input"
                        placeholder="Actor, entity, IP, details">
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Entity</label>
                    <select name="entity_type" class="form-select search-input"
                        style="background-color: rgba(255,255,255,.06)">
                        <option value="">All</option>
                        <option value="Client">Client</option>
                        <option value="Deal">Deal</option>
                        <option value="Task">Task</option>
                        <option value="Source">Source</option>
                        <option value="User">User</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Action</label>
                    <select name="action" class="form-select search-input" style="background-color: rgba(255,255,255,.06)">
                        <option value="">Any</option>
                        <option value="created">Created</option>
                        <option value="updated">Updated</option>
                        <option value="deleted">Deleted</option>
                        <option value="restored">Restored</option>
                        <option value="status_changed">Status changed</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Date from</label>
                    <input type="date" name="from" class="form-control search-input">
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Date to</label>
                    <input type="date" name="to" class="form-control search-input">
                </div>

                <div class="col-md-1 d-grid">
                    <button class="btn btn-soft">
                        <i class="bi bi-funnel me-1"></i>Go
                    </button>
                </div>

            </form>
        </div>

        <!-- Logs table -->
        <div class="glass p-0">
            <div class="table-responsive">
                <table class="table table-darkish table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-nowrap">Date</th>
                            <th>Actor</th>
                            <th>Entity</th>
                            <th>Action</th>
                            <th class="text-nowrap">IP / Agent</th>
                            <th class="text-end">More</th>
                        </tr>
                    </thead>
                    <tbody>

                        <!-- Example row: updated deal -->
                        @foreach ($logs as $log)
                            <tr>
                                <td class="text-nowrap">
                                    <div class="text-white">{{ $log->created_at->format('d.m.Y, m:h') }}</div>
                                </td>
                                <td>
                                    <div class="text-white fw-semibold">{{ $log->actor->name }}</div>
                                    <div class="text-muted-soft small">{{ $log->actor->email }}</div>
                                </td>
                                <td>
                                    <div class="text-white">
                                        {{ $log->entity_type }} #{{ $log->entity_id }}
                                    </div>
                                </td>
                                <td>
                                    @if ($log->action == 'create')
                                        <span class="badge badge-log-created rounded-pill">{{ $log->action }}</span>
                                    @elseif ($log->action == 'update')
                                        <span class="badge  badge-log-updated rounded-pill">{{ $log->action }}</span>
                                    @elseif ($log->action == 'status_change')
                                        <span class="badge  badge-log-status rounded-pill">{{ $log->action }}</span>
                                    @elseif ($log->action == 'delete')
                                        <span class="badge  badge-log-deleted rounded-pill">{{ $log->action }}</span>
                                    @endif
                                </td>
                                <td class="text-muted-soft small">
                                    {{ $log->ip }}<br>
                                    <span class="text-truncate d-inline-block" style="max-width: 180px;">
                                        {{ $log->user_agent }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('logs.show', $log->id) }}"
                                        class="btn btn-sm btn-soft rounded-pill px-3">
                                        <i class="bi bi-box-arrow-up-right me-1"></i>Details
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center p-3">
                <div class="text-muted-soft small">Showing 1–3 of 128</div>
                <div class="d-flex gap-2">
                    <button class="btn btn-soft btn-sm rounded-pill">Prev</button>
                    <button class="btn btn-soft btn-sm rounded-pill">Next</button>
                </div>
            </div>
        </div>

        <style>
            .chip {
                display: inline-flex;
                align-items: center;
                gap: .25rem;
                padding: .35rem .75rem;
                border-radius: 999px;
                background: rgba(255, 255, 255, .06);
                border: 1px solid rgba(255, 255, 255, .10);
                color: rgba(255, 255, 255, .86);
                text-decoration: none;
            }

            .chip:hover {
                background: rgba(255, 255, 255, .10);
                color: #fff;
            }

            .badge-log-created {
                background: rgba(25, 135, 84, .18);
                border: 1px solid rgba(25, 135, 84, .55);
                color: #c7f7dc;
                text-transform: capitalize;
            }

            .badge-log-updated {
                background: rgba(13, 110, 253, .16);
                border: 1px solid rgba(13, 110, 253, .55);
                color: #c7dcff;
                text-transform: capitalize;
            }

            .badge-log-status {
                background: rgba(111, 66, 193, .18);
                border: 1px solid rgba(111, 66, 193, .55);
                color: #e0d0ff;
                text-transform: capitalize;
            }

            .badge-log-deleted {
                background: rgba(220, 53, 69, .18);
                border: 1px solid rgba(220, 53, 69, .55);
                color: #ffb3b8;
                text-transform: capitalize;
            }
        </style>

    </main>
@endsection
