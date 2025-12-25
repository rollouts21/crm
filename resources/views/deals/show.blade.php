@extends('layouts.main')
@section('title')
    View Deal
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <!-- Page header -->
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <a href="/deals" class="chip">
                        <i class="bi bi-arrow-left me-2"></i>Back to Deals
                    </a>
                    <span class="chip"><i class="bi bi-hash me-2"></i>Deal #{{ $deal->id }}</span>
                    <a href="/clients/88" class="chip">
                        <i class="bi bi-person me-2"></i>Client: {{ $client->name }}
                    </a>
                </div>

                <h1 class="h3 text-white mb-1">{{ $deal->title }}</h1>
                <div class="text-muted-soft">Deal details, tasks, notes and audit history</div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('clients.deals.edit', [$client->id, $deal->id]) }}"
                    class="btn btn-soft rounded-pill px-3">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
            </div>
        </div>

        <!-- Summary + side -->
        <div class="row g-3 mb-4">
            <div class="col-lg-8">
                <div class="glass p-4 h-100">
                    <div class="d-flex flex-column flex-md-row align-items-md-start justify-content-between gap-3">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge text-bg-primary rounded-pill">{{ $deal->status->label() }}</span>
                                <span class="chip"><i class="bi bi-person-check me-2"></i>Owner:
                                    {{ $deal->owner->name }}</span>
                                <span class="chip"><i class="bi bi-calendar-event me-2"></i>Expected:
                                    {{ $deal->expected_close_at->format('m.d.Y') }}</span>
                            </div>

                            <div class="row g-3 mt-1">
                                <div class="col-md-6">
                                    <div class="text-muted-soft small mb-1">Amount</div>
                                    <div class="text-white fw-semibold h4 mb-0">
                                        {{ number_format($deal->amount, 2, ',', ' ') }} RUB</div>
                                </div>

                                <div class="col-md-6">
                                    <div class="text-muted-soft small mb-1">Dates</div>
                                    <div class="text-white">Created: {{ $deal->created_at->format('d.m.Y') }}</div>
                                    <div class="text-white">Updated: {{ $deal->updated_at->diffForHumans() }}</div>
                                    <div class=" {{ $deal->closed_at != null ? 'text-white' : 'text-muted-soft' }}">Closed:
                                        {{ $deal->closed_at != null ? $deal->closed_at->format('d.m.Y') : 'Not closed' }}
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-muted-soft small mb-1">Comment</div>
                                    <div class="text-white">
                                        {{ $deal->comment }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2" style="min-width: 260px;">
                            <div class="kpi-card p-3">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <div class="text-muted-soft small">Open tasks</div>
                                        <div class="h4 text-white fw-semibold mb-0">{{ $client->allTasks() }}</div>
                                    </div>
                                    <div class="kpi-icon"><i class="bi bi-check2-square text-white"></i></div>
                                </div>
                            </div>


                            <a href="{{ route('clients.deals.tasks.create', [$client->id, $deal->id]) }}"
                                class="btn btn-primary rounded-pill px-3">
                                <i class="bi bi-plus-lg me-1"></i>Add Task
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass p-4 h-100">
                    <div class="text-white fw-semibold mb-1">Client</div>
                    <div class="text-muted-soft small mb-3">Quick access to the client profile</div>

                    <div class="d-flex align-items-start gap-3 mb-3">
                        <div>
                            <div class="text-white fw-semibold">{{ $client->name }}</div>
                            <div class="text-muted-soft small">{{ $client->source->name }} •
                                {{ $client->status->label() }}
                            </div>
                            <div class="mt-2 d-flex gap-2">
                                <a href="{{ route('clients.show', $client->id) }}"
                                    class="btn btn-soft btn-sm rounded-pill px-3">Open Client</a>
                                <a href="{{ route('clients.edit', $client->id) }}"
                                    class="btn btn-outline-light btn-sm rounded-pill px-3">Edit</a>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>

        <!-- Tabs -->
        <div class="glass p-3">
            <ul class="nav nav-pills gap-2" id="dealTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill px-3" id="dealTasksTab" data-bs-toggle="pill"
                        data-bs-target="#dealTasks" type="button" role="tab">
                        <i class="bi bi-check2-square me-2"></i>Tasks
                    </button>
                </li>
                @can('view', auth()->user())
                    <li class="nav-item" role="presentation">
                        <button class="nav-link rounded-pill px-3" id="dealHistoryTab" data-bs-toggle="pill"
                            data-bs-target="#dealHistory" type="button" role="tab">
                            <i class="bi bi-activity me-2"></i>History
                        </button>
                    </li>
                @endcan
            </ul>

            <div class="tab-content pt-3">
                <!-- Tasks -->
                <div class="tab-pane fade show active" id="dealTasks" role="tabpanel" aria-labelledby="dealTasksTab">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div class="text-white fw-semibold">Tasks</div>
                            <div class="text-muted-soft small">Follow-ups related to this deal</div>
                        </div>
                        <a href="{{ route('clients.deals.tasks.create', [$client->id, $deal->id]) }}"
                            class="btn btn-primary btn-sm rounded-pill px-3">
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
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($deal->tasks as $task)
                                    <tr>
                                        <td>
                                            <div class="fw-semibold text-white">{{ $task->title }}</div>
                                            <div class="text-muted-soft small">{{ $task->description }}</div>
                                        </td>
                                        <td class="text-nowrap">{{ $task->due_at->format('d.m.Y') }}</td>
                                        <td><span
                                                class="badge {{ $task->priority->badgeClass() }} rounded-pill">{{ $task->priority->label() }}</span>
                                        </td>
                                        <td><span
                                                class="badge {{ $task->status->badgeClass() }} rounded-pill">{{ $task->status->label() }}</span>
                                        </td>
                                        <td class="text-end">
                                            <a href="{{ route('clients.deals.tasks.edit', [$client->id, $deal->id, $task->id]) }}"
                                                class="btn btn-sm btn-outline-light rounded-pill px-3">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>


                <!-- History -->
                <div class="tab-pane fade" id="dealHistory" role="tabpanel" aria-labelledby="dealHistoryTab">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div class="text-white fw-semibold">History</div>
                            <div class="text-muted-soft small">Audit log events for this deal</div>
                        </div>
                        <a href="/logs?entity=Deal&entity_id=152" class="btn btn-soft btn-sm rounded-pill px-3">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Open Logs
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-darkish table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="text-nowrap">Date</th>
                                    <th>Actor</th>
                                    <th>Action</th>
                                    <th>Details</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-nowrap">Today 09:10</td>
                                    <td>Admin</td>
                                    <td><span class="badge text-bg-primary rounded-pill">Updated</span></td>
                                    <td class="text-muted-soft">Changed status: new → in_progress</td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap">Yesterday 18:02</td>
                                    <td>Admin</td>
                                    <td><span class="badge text-bg-success rounded-pill">Created</span></td>
                                    <td class="text-muted-soft">Deal created with amount €2,500</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

        <!-- Won modal -->
        {{-- <div class="modal fade" id="markWonModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-white"
                    style="background: rgba(11,18,32,.95); border: 1px solid rgba(255,255,255,.12); backdrop-filter: blur(10px);">
                    <div class="modal-header" style="border-color: rgba(255,255,255,.10);">
                        <h5 class="modal-title">Mark deal as Won</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        This will set <strong>closed_at</strong> automatically and create an audit log entry.
                    </div>
                    <div class="modal-footer" style="border-color: rgba(255,255,255,.10);">
                        <form action="{{ route('clients.deals.update', [$deal->client->id, $deal->id]) }}"
                            method="post">
                            @csrf
                            @method('patch')
                            <input type="hidden" name="status" value="won">
                            <button type="button" class="btn btn-soft rounded-pill px-3"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-outline-success rounded-pill px-3">Confirm Won</button>
                        </form>
                    </div>
                </div>
            </div>
        </div> --}}

        <!-- Lost modal -->
        {{-- <div class="modal fade" id="markLostModal" tabindex="-1" aria-hidden="true">
            <form action="{{ route('clients.deals.update', [$deal->client->id, $deal->id]) }}" method="post">
                @csrf
                @method('patch')
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content text-white"
                        style="background: rgba(11,18,32,.95); border: 1px solid rgba(255,255,255,.12); backdrop-filter: blur(10px);">
                        <div class="modal-header" style="border-color: rgba(255,255,255,.10);">
                            <h5 class="modal-title">Mark deal as Lost</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <div class="text-muted-soft small mb-2">Comment is required for Lost deals.</div>
                            <label class="form-label text-muted-soft small">Lost reason / comment</label>
                            <textarea class="form-control search-input" rows="4" name="lost_reason"
                                placeholder="Explain why the deal was lost..."></textarea>
                        </div>
                        <div class="modal-footer" style="border-color: rgba(255,255,255,.10);">
                            <button type="button" class="btn btn-soft rounded-pill px-3"
                                data-bs-dismiss="modal">Cancel</button>
                            <input type="hidden" name="status" value="lost">
                            <button type="submit" class="btn btn-outline-danger rounded-pill px-3">Confirm Lost</button>
                        </div>
                    </div>
                </div>
            </form>
        </div> --}}

    </main>
@endsection
