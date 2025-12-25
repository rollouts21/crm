@extends('layouts.main')
@section('title')
    Tasks
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <!-- Page header -->
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 text-white mb-1">Tasks</h1>
                <div class="text-muted-soft">Today, overdue and upcoming follow-ups</div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('deals.index') }}" class="btn btn-primary rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i>Add Task
                </a>

            </div>
        </div>

        <!-- Tabs -->
        <div class="glass p-3 mb-4">
            <ul class="nav nav-pills gap-2" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link rounded-pill px-3 active" href="/tasks?tab=today">
                        <i class="bi bi-list-task"></i> All
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link rounded-pill px-3" href="/tasks?tab=today">
                        <i class="bi bi-sun me-2"></i>Today
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link rounded-pill px-3" href="/tasks?tab=overdue">
                        <i class="bi bi-exclamation-triangle me-2"></i>Overdue
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link rounded-pill px-3" href="/tasks?tab=upcoming">
                        <i class="bi bi-calendar-week me-2"></i>Upcoming
                    </a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link rounded-pill px-3" href="/tasks?tab=done">
                        <i class="bi bi-check2-circle me-2"></i>Done
                    </a>
                </li>
            </ul>
        </div>

        <!-- Filters -->
        <div class="glass p-3 mb-4">
            <form class="row g-2 align-items-end" method="GET" action="/tasks">
                <div class="col-md-4">
                    <label class="form-label text-muted-soft small">Search</label>
                    <input type="text" class="form-control search-input" name="search"
                        placeholder="Title or description">
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Status</label>
                    <select class="form-select search-input" name="status" style="background-color: rgba(255,255,255,.06)">
                        <option value="">Any</option>
                        <option value="open">Open</option>
                        <option value="done">Done</option>
                        <option value="canceled">Canceled</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Priority</label>
                    <select class="form-select search-input" name="priority"
                        style="background-color: rgba(255,255,255,.06)">
                        <option value="">Any</option>
                        <option value="high">High</option>
                        <option value="normal">Normal</option>
                        <option value="low">Low</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Context</label>
                    <select class="form-select search-input" name="context" style="background-color: rgba(255,255,255,.06)">
                        <option value="">All</option>
                        <option value="client">Client</option>
                        <option value="deal">Deal</option>
                        <option value="none">No context</option>
                    </select>
                </div>

                <div class="col-md-2 d-grid">
                    <button class="btn btn-soft">
                        <i class="bi bi-funnel me-1"></i>Apply
                    </button>
                </div>
            </form>
        </div>

        <!-- Tasks table -->
        <div class="glass p-0">
            <div class="table-responsive">
                <table class="table table-darkish table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Task</th>
                            <th class="text-nowrap">Due</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th>Related</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr class="{{ $task->due_at < now() ? 'row-overdue' : '' }}">

                                <td>
                                    <div class="fw-semibold text-white">{{ $task->title }}</div>
                                    <div class="text-muted-soft small">{{ $task->description }}
                                    </div>
                                </td>
                                <td class="text-nowrap">
                                    <span
                                        class="badge  {{ $task->due_at < now() ? 'badge-outline-danger' : 'badge-outline-success' }} rounded-pill">{{ $task->due_at->format('d.m.Y') }}</span>
                                </td>
                                <td><span
                                        class="badge {{ $task->priority->badgeClass() }} rounded-pill">{{ $task->priority->label() }}</span>
                                </td>
                                <td><span
                                        class="badge {{ $task->status->badgeClass() }} rounded-pill">{{ $task->status->label() }}</span>
                                </td>
                                <td class="text-muted-soft">
                                    <a class="link-soft" href="{{ route('clients.show', $task->client->id) }}">Client:
                                        {{ $task->client->name }}</a>
                                    <div class="small">Deal: <a class="link-soft"
                                            href="{{ route('clients.deals.show', [$task->client->id, $task->deal->id]) }}">{{ $task->deal->id }}</a>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <form
                                        action="{{ route('clients.deals.tasks.update', [$task->client->id, $task->deal->id, $task->id]) }}"
                                        method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button class="btn btn-sm btn-outline-success rounded-pill px-3" name="status"
                                            value="done" type="submit">
                                            <i class="bi bi-check2 me-1"></i>Done
                                        </button>
                                        <a href="{{ route('clients.deals.tasks.edit', [$task->client->id, $task->deal->id, $task->id]) }}"
                                            class="btn btn-sm btn-outline-light rounded-pill px-3">Edit</a>
                                        <button class="btn btn-sm btn-soft rounded-pill px-3" type="submit"
                                            name="status" value="canceled">
                                            Cancel
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        @endforeach


                    </tbody>
                </table>
            </div>

            <!-- Pagination placeholder -->
            <div class="d-flex justify-content-between align-items-center p-3">
                <div class="text-muted-soft small">
                    Showing
                    {{ $tasks->firstItem() ?? 0 }}–{{ $tasks->lastItem() ?? 0 }}
                    of {{ $tasks->total() }}
                </div>

                <div class="d-flex gap-2">
                    {{-- Prev --}}
                    @if ($tasks->onFirstPage())
                        <span class="btn btn-soft btn-sm rounded-pill disabled">Prev</span>
                    @else
                        <a class="btn btn-soft btn-sm rounded-pill" href="{{ $tasks->previousPageUrl() }}">Prev</a>
                    @endif

                    {{-- Next --}}
                    @if ($tasks->hasMorePages())
                        <a class="btn btn-soft btn-sm rounded-pill" href="{{ $tasks->nextPageUrl() }}">Next</a>
                    @else
                        <span class="btn btn-soft btn-sm rounded-pill disabled">Next</span>
                    @endif
                </div>
            </div>
        </div>


        <style>
            .row-overdue {
                box-shadow: inset 4px 0 0 rgba(220, 53, 69, .7);
            }

            .badge-outline-danger {
                border: 1px solid rgba(220, 53, 69, .55);
                color: rgba(255, 255, 255, .92);
                background: rgba(220, 53, 69, .14);
            }

            .badge-outline-warning {
                border: 1px solid rgba(255, 193, 7, .55);
                color: rgba(255, 255, 255, .92);
                background: rgba(255, 193, 7, .14);
            }

            .link-soft {
                color: rgba(255, 255, 255, .78);
                text-decoration: none;
                border-bottom: 1px dashed rgba(255, 255, 255, .25);
                padding-bottom: 2px;
            }

            .link-soft:hover {
                color: #fff;
                border-bottom-color: rgba(255, 255, 255, .45);
            }
        </style>

    </main>
@endsection
