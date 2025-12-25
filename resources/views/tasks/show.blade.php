@extends('layouts.main')
@section('title')
    View Task
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <a href="/tasks" class="chip">
                        <i class="bi bi-arrow-left me-2"></i>Back to Tasks
                    </a>
                    <span class="chip"><i class="bi bi-hash me-2"></i>Task #403</span>
                    <span class="badge text-bg-primary rounded-pill">Open</span>
                    <span class="badge text-bg-danger rounded-pill">High</span>
                </div>

                <h1 class="h3 text-white mb-1">Call client to clarify scope</h1>
                <div class="text-muted-soft">Task details and context</div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="/tasks/403/edit" class="btn btn-soft rounded-pill px-3">
                    <i class="bi bi-pencil me-1"></i>Edit
                </a>
                <button class="btn btn-outline-success rounded-pill px-3" type="button">
                    <i class="bi bi-check2 me-1"></i>Mark Done
                </button>
                <button class="btn btn-outline-danger rounded-pill px-3" type="button" data-bs-toggle="modal"
                    data-bs-target="#cancelTaskModal">
                    <i class="bi bi-x-circle me-1"></i>Cancel
                </button>
            </div>
        </div>

        <div class="row g-3">
            <div class="col-lg-8">
                <div class="glass p-4">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="text-muted-soft small mb-1">Due</div>
                            <div class="text-white fw-semibold">Today 12:00</div>
                            <div class="text-muted-soft small mt-1">Overdue highlighting appears automatically in lists.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted-soft small mb-1">Status</div>
                            <div class="d-flex gap-2 flex-wrap">
                                <span class="badge text-bg-primary rounded-pill">Open</span>
                                <span class="badge text-bg-danger rounded-pill">High</span>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="text-muted-soft small mb-1">Description</div>
                            <div class="text-white">
                                Ask about pages + integrations. Confirm budget and timeline. Propose 2 variants.
                            </div>
                        </div>
                    </div>

                    <hr class="my-4" style="border-color: rgba(255,255,255,.08);">

                    <div class="d-flex justify-content-between align-items-start gap-3">
                        <div>
                            <div class="text-white fw-semibold">Audit</div>
                            <div class="text-muted-soft small">Recent changes</div>
                        </div>
                        <a href="/logs?entity=Task&entity_id=403" class="btn btn-soft btn-sm rounded-pill px-3">
                            <i class="bi bi-box-arrow-up-right me-1"></i>Open Logs
                        </a>
                    </div>

                    <div class="table-responsive mt-3">
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
                                    <td class="text-nowrap">Today 09:20</td>
                                    <td>Manager</td>
                                    <td><span class="badge text-bg-primary rounded-pill">Updated</span></td>
                                    <td class="text-muted-soft">Changed priority: normal → high</td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap">Yesterday 18:02</td>
                                    <td>Manager</td>
                                    <td><span class="badge text-bg-success rounded-pill">Created</span></td>
                                    <td class="text-muted-soft">Task created with due date Today 12:00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass p-4">
                    <div class="text-white fw-semibold mb-1">Related</div>
                    <div class="text-muted-soft small mb-3">Quick access to linked entities</div>

                    <div class="d-grid gap-2">
                        <a class="btn btn-soft rounded-pill text-start px-3" href="/clients/88">
                            <i class="bi bi-person me-2"></i>Client: Coffee House
                            <div class="text-muted-soft small ms-4">Status: Qualified</div>
                        </a>
                        <a class="btn btn-soft rounded-pill text-start px-3" href="/deals/152">
                            <i class="bi bi-briefcase me-2"></i>Deal: #152 Website redesign
                            <div class="text-muted-soft small ms-4">Status: In progress</div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cancel modal -->
        <div class="modal fade" id="cancelTaskModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content text-white"
                    style="background: rgba(11,18,32,.95); border: 1px solid rgba(255,255,255,.12); backdrop-filter: blur(10px);">
                    <div class="modal-header" style="border-color: rgba(255,255,255,.10);">
                        <h5 class="modal-title">Cancel task</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-muted-soft small mb-2">Optional note</div>
                        <textarea class="form-control search-input" rows="3" placeholder="Why is this task canceled?"></textarea>
                    </div>
                    <div class="modal-footer" style="border-color: rgba(255,255,255,.10);">
                        <button type="button" class="btn btn-soft rounded-pill px-3" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-danger rounded-pill px-3">Confirm cancel</button>
                    </div>
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
        </style>

    </main>
@endsection
