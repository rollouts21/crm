@extends('layouts.main')
@section('title')
    View Client
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <!-- Page header -->
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <a href="{{ route('clients.index') }}" class="chip">
                        <i class="bi bi-arrow-left me-2"></i>Back to Clients
                    </a>
                    <span class="chip">
                        <i class="bi bi-person-badge me-2"></i>Client #{{ $client->id }}
                    </span>
                </div>

                <h1 class="h3 text-white mb-1">{{ $client->name }}</h1>
                <div class="text-muted-soft">Client profile, deals, tasks, notes and activity</div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('clients.edit', $client->id) }}" class="btn btn-soft rounded-pill px-3">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>

                <button class="btn btn-outline-light rounded-pill px-3" data-bs-toggle="modal"
                    data-bs-target="#changeStatusModal">
                    <i class="bi bi-arrow-repeat me-1"></i>Change Status
                </button>

                <button class="btn btn-outline-danger rounded-pill px-3" data-bs-toggle="modal"
                    data-bs-target="#deleteClientModal">
                    <i class="bi bi-trash me-1"></i>Delete
                </button>
            </div>
        </div>

        <!-- Summary + Quick actions -->
        <div class="row g-3 mb-4">
            <!-- Summary card -->
            <div class="">
                <div class="glass p-4 h-100">
                    <div class="d-flex flex-column flex-md-row align-items-md-start justify-content-between gap-3">
                        <div>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <span class="badge {{ $client->status->badgeClass() }} rounded-pill">
                                    {{ $client->status->label() }} </span>
                                <span class="chip"><i class="bi bi-diagram-3 me-2"></i>Source:
                                    {{ $client->source->name }}</span>
                                <span class="chip"><i class="bi bi-person-check me-2"></i>Owner:
                                    {{ $client->owner->name }}</span>
                            </div>

                            <div class="text-muted-soft small mb-3">
                                Last contact: <span
                                    class="text-white">{{ $client->last_contact_at != null ? $client->last_contact_at->format('d.m.y, h:m') : 'Not Contacted' }}</span>
                                <span class="mx-2">•</span>
                                Created: <span class="text-white">{{ $client->created_at->format('d.m.y, h:m') }}</span>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="text-muted-soft small mb-1">Phone</div>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-telephone text-muted-soft"></i>
                                        <a class="text-white text-decoration-underline"
                                            href="tel:+{{ $client->phone }}">{{ $client->phone }}</a>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="text-muted-soft small mb-1">Email</div>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-envelope text-muted-soft"></i>
                                        <a class="text-white text-decoration-underline"
                                            href="mailto:{{ $client->email }}">{{ $client->email }}</a>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="text-muted-soft small mb-1">City</div>
                                    <div class="d-flex align-items-center gap-2">
                                        <i class="bi bi-geo-alt text-muted-soft"></i>
                                        <span class="text-white">{{ $client->city }}</span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-muted-soft small mb-1">Note</div>
                                    <div class="text-white">
                                        {{ $client->note }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Mini stats -->
                        <div class="d-grid gap-2" style="min-width: 260px;">
                            <div class="kpi-card p-3">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <div class="text-muted-soft small">Deals</div>
                                        <div class="h4 text-white fw-semibold mb-0">3</div>
                                    </div>
                                    <div class="kpi-icon"><i class="bi bi-cash-stack text-white"></i></div>
                                </div>
                            </div>

                            <div class="kpi-card p-3">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <div class="text-muted-soft small">Open tasks</div>
                                        <div class="h4 text-white fw-semibold mb-0">2</div>
                                    </div>
                                    <div class="kpi-icon"><i class="bi bi-check2-square text-white"></i></div>
                                </div>
                            </div>

                            <div class="kpi-card p-3">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div>
                                        <div class="text-muted-soft small">Won (total)</div>
                                        <div class="h4 text-white fw-semibold mb-0">€4,800</div>
                                    </div>
                                    <div class="kpi-icon"><i class="bi bi-trophy text-white"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quick actions -->
                    <hr class="my-4" style="border-color: rgba(255,255,255,.08);">

                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('clients.deals.create', $client->id) }}"
                            class="btn btn-primary rounded-pill px-3">
                            <i class="bi bi-plus-lg me-1"></i>Add Deal
                        </a>
                        <a href="/tasks/create?client_id=88" class="btn btn-soft rounded-pill px-3">
                            <i class="bi bi-plus-lg me-1"></i>Add Task
                        </a>
                        {{-- <button class="btn btn-soft rounded-pill px-3" data-bs-toggle="collapse"
                            data-bs-target="#addNoteCollapse">
                            <i class="bi bi-journal-text me-1"></i>Add Note
                        </button> --}}
                        <a href="/logs?entity=Client&entity_id=88" class="btn btn-soft rounded-pill px-3">
                            <i class="bi bi-activity me-1"></i>View Logs
                        </a>
                    </div>

                    <!-- Add note collapse -->
                    {{-- <div class="collapse mt-3" id="addNoteCollapse">
                        <div class="glass p-3">
                            <form>
                                <label class="form-label text-muted-soft small">New note</label>
                                <textarea class="form-control search-input" rows="3" placeholder="Write something..."></textarea>
                                <div class="d-flex gap-2 mt-2">
                                    <button class="btn btn-primary btn-sm rounded-pill px-3" type="button">
                                        Save Note
                                    </button>
                                    <button class="btn btn-soft btn-sm rounded-pill px-3" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#addNoteCollapse">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div> --}}

                </div>
            </div>


        </div>

        <!-- Tabs -->
        <div class="glass p-3">
            <ul class="nav nav-pills gap-2" id="clientTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-pill px-3" id="deals-tab" data-bs-toggle="pill"
                        data-bs-target="#deals" type="button" role="tab">
                        <i class="bi bi-cash-stack me-2"></i>Deals
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-3" id="tasks-tab" data-bs-toggle="pill"
                        data-bs-target="#tasks" type="button" role="tab">
                        <i class="bi bi-check2-square me-2"></i>Tasks
                    </button>
                </li>
                {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-3" id="notes-tab" data-bs-toggle="pill"
                        data-bs-target="#notes" type="button" role="tab">
                        <i class="bi bi-journal-text me-2"></i>Notes
                    </button>
                </li> --}}
                <li class="nav-item" role="presentation">
                    <button class="nav-link rounded-pill px-3" id="history-tab" data-bs-toggle="pill"
                        data-bs-target="#history" type="button" role="tab">
                        <i class="bi bi-activity me-2"></i>History
                    </button>
                </li>
            </ul>

            <div class="tab-content pt-3" id="clientTabsContent">

                <!-- Deals tab -->
                <div class="tab-pane fade show active" id="deals" role="tabpanel" aria-labelledby="deals-tab">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div class="text-white fw-semibold">Deals</div>
                            <div class="text-muted-soft small">All deals related to this client</div>
                        </div>
                        <a href="/clients/88/deals/create" class="btn btn-primary btn-sm rounded-pill px-3">
                            <i class="bi bi-plus-lg me-1"></i>Add Deal
                        </a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-darkish table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th class="text-nowrap">Expected close</th>
                                    <th class="text-nowrap">Closed at</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">Website redesign</div>
                                        <div class="text-muted-soft small">Deal #152</div>
                                    </td>
                                    <td class="text-nowrap">€2,500</td>
                                    <td><span class="badge text-bg-primary rounded-pill">In progress</span></td>
                                    <td class="text-nowrap">2026-01-10</td>
                                    <td class="text-muted-soft">—</td>
                                    <td class="text-end">
                                        <a href="/deals/152" class="btn btn-sm btn-soft rounded-pill px-3">View</a>
                                        <a href="/deals/152/edit"
                                            class="btn btn-sm btn-outline-light rounded-pill px-3">Edit</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">Landing page</div>
                                        <div class="text-muted-soft small">Deal #131</div>
                                    </td>
                                    <td class="text-nowrap">€1,200</td>
                                    <td><span class="badge text-bg-success rounded-pill">Won</span></td>
                                    <td class="text-muted-soft">—</td>
                                    <td class="text-nowrap">2025-12-12</td>
                                    <td class="text-end">
                                        <a href="/deals/131" class="btn btn-sm btn-soft rounded-pill px-3">View</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">Ads setup</div>
                                        <div class="text-muted-soft small">Deal #120</div>
                                    </td>
                                    <td class="text-nowrap">€1,100</td>
                                    <td><span class="badge text-bg-danger rounded-pill">Lost</span></td>
                                    <td class="text-muted-soft">—</td>
                                    <td class="text-nowrap">2025-11-30</td>
                                    <td class="text-end">
                                        <a href="/deals/120" class="btn btn-sm btn-soft rounded-pill px-3">View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Tasks tab -->
                <div class="tab-pane fade" id="tasks" role="tabpanel" aria-labelledby="tasks-tab">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div class="text-white fw-semibold">Tasks</div>
                            <div class="text-muted-soft small">Reminders and follow-ups</div>
                        </div>
                        <a href="/tasks/create?client_id=88" class="btn btn-soft btn-sm rounded-pill px-3">
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
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">Call client</div>
                                        <div class="text-muted-soft small">Follow-up after proposal</div>
                                    </td>
                                    <td class="text-nowrap">Today 12:00</td>
                                    <td><span class="badge text-bg-danger rounded-pill">High</span></td>
                                    <td><span class="badge text-bg-primary rounded-pill">Open</span></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-success rounded-pill px-3" type="button">
                                            <i class="bi bi-check2 me-1"></i>Done
                                        </button>
                                        <a href="/tasks/403/edit"
                                            class="btn btn-sm btn-outline-light rounded-pill px-3">Edit</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">Send invoice</div>
                                        <div class="text-muted-soft small">For landing page</div>
                                    </td>
                                    <td class="text-nowrap text-warning">Overdue</td>
                                    <td><span class="badge text-bg-warning rounded-pill">Normal</span></td>
                                    <td><span class="badge text-bg-primary rounded-pill">Open</span></td>
                                    <td class="text-end">
                                        <button class="btn btn-sm btn-outline-success rounded-pill px-3" type="button">
                                            <i class="bi bi-check2 me-1"></i>Done
                                        </button>
                                        <a href="/tasks/399/edit"
                                            class="btn btn-sm btn-outline-light rounded-pill px-3">Edit</a>
                                    </td>
                                </tr>

                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">Prepare contract</div>
                                        <div class="text-muted-soft small">Website redesign</div>
                                    </td>
                                    <td class="text-nowrap">Tomorrow 10:00</td>
                                    <td><span class="badge text-bg-secondary rounded-pill">Low</span></td>
                                    <td><span class="badge text-bg-secondary rounded-pill">Done</span></td>
                                    <td class="text-end">
                                        <a href="/tasks/377/edit"
                                            class="btn btn-sm btn-outline-light rounded-pill px-3">View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Notes tab -->
                {{-- <div class="tab-pane fade" id="notes" role="tabpanel" aria-labelledby="notes-tab">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div class="text-white fw-semibold">Notes</div>
                            <div class="text-muted-soft small">Internal comments and updates</div>
                        </div>
                        <button class="btn btn-soft btn-sm rounded-pill px-3" data-bs-toggle="collapse"
                            data-bs-target="#noteForm2">
                            <i class="bi bi-plus-lg me-1"></i>Add Note
                        </button>
                    </div>

                    <div class="collapse mb-3" id="noteForm2">
                        <div class="glass p-3">
                            <form>
                                <label class="form-label text-muted-soft small">New note</label>
                                <textarea class="form-control search-input" rows="3" placeholder="Write something..."></textarea>
                                <div class="d-flex gap-2 mt-2">
                                    <button class="btn btn-primary btn-sm rounded-pill px-3" type="button">Save</button>
                                    <button class="btn btn-soft btn-sm rounded-pill px-3" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#noteForm2">Cancel</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <div class="glass p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-white fw-semibold">Discussed requirements</div>
                                    <div class="text-muted-soft small">Needs website redesign + ads</div>
                                </div>
                                <small class="text-muted-soft text-nowrap">Today</small>
                            </div>
                        </div>

                        <div class="glass p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-white fw-semibold">Contact preference</div>
                                    <div class="text-muted-soft small">Email only, no calls after 18:00</div>
                                </div>
                                <small class="text-muted-soft text-nowrap">Yesterday</small>
                            </div>
                        </div>

                        <div class="glass p-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <div class="text-white fw-semibold">Sent first proposal</div>
                                    <div class="text-muted-soft small">Waiting for feedback</div>
                                </div>
                                <small class="text-muted-soft text-nowrap">2025-12-12</small>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- History tab -->
                <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div class="text-white fw-semibold">History</div>
                            <div class="text-muted-soft small">Audit log events for this client</div>
                        </div>
                        <a href="/logs?entity=Client&entity_id=88" class="btn btn-soft btn-sm rounded-pill px-3">
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
                                    <td class="text-nowrap">Today 10:21</td>
                                    <td>Admin</td>
                                    <td><span class="badge text-bg-primary rounded-pill">Updated</span></td>
                                    <td class="text-muted-soft">Changed status: contacted → qualified</td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap">Yesterday 18:02</td>
                                    <td>Admin</td>
                                    <td><span class="badge text-bg-success rounded-pill">Created</span></td>
                                    <td class="text-muted-soft">Client created (source: Instagram)</td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap">2025-12-12</td>
                                    <td>Manager</td>
                                    <td><span class="badge text-bg-secondary rounded-pill">Note</span></td>
                                    <td class="text-muted-soft">Added note “Waiting for feedback”</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>

        <!-- Change status modal -->
        <div class="modal fade" id="changeStatusModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-white"
                    style="background: rgba(11,18,32,.95); border: 1px solid rgba(255,255,255,.12); backdrop-filter: blur(10px);">
                    <form action="{{ route('clients.update', $client->id) }}" method="post">
                        @csrf
                        @method('patch')
                        <div class="modal-header" style="border-color: rgba(255,255,255,.10);">
                            <h5 class="modal-title">Change status</h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label text-muted-soft small">Status</label>
                            <select class="form-select search-input" name="status"
                                style="background-color: rgba(255,255,255,.06)">
                                @foreach (\App\Enums\ClientStatusEnum::cases() as $status)
                                    <option class="text-black" value="{{ $status->value }}">{{ $status->label() }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="text-muted-soft small mt-2">
                                Tip: status changes will be written to audit log.
                            </div>
                        </div>
                        <div class="modal-footer" style="border-color: rgba(255,255,255,.10);">
                            <button type="button" class="btn btn-soft rounded-pill px-3"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary rounded-pill px-3">Save</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>

        <!-- Delete modal -->
        <div class="modal fade" id="deleteClientModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-white"
                    style="background: rgba(11,18,32,.95); border: 1px solid rgba(255,255,255,.12); backdrop-filter: blur(10px);">
                    <div class="modal-header" style="border-color: rgba(255,255,255,.10);">
                        <h5 class="modal-title">Delete client</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete <strong>Coffee House</strong>? You can restore it later (soft
                        delete).
                    </div>
                    <div class="modal-footer" style="border-color: rgba(255,255,255,.10);">
                        <form action="{{ route('clients.destroy', $client->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="button" class="btn btn-soft rounded-pill px-3"
                                data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-outline-danger rounded-pill px-3">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </main>
@endsection
