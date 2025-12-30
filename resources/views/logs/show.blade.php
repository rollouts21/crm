@extends('layouts.main')
@section('title')
    Show Log
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <!-- Header -->
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <div class="d-flex align-items-center gap-2 mb-2">
                    <a href="/logs" class="chip">
                        <i class="bi bi-arrow-left me-2"></i>Back to Activity Log
                    </a>
                    <span class="chip">
                        <i class="bi bi-hash me-2"></i>Log #{{ $log->id }}
                    </span>
                    @if ($log->action == 'create')
                        <span class="badge badge-log-created rounded-pill">{{ $log->action }}</span>
                    @elseif ($log->action == 'update')
                        <span class="badge  badge-log-updated rounded-pill">{{ $log->action }}</span>
                    @elseif ($log->action == 'status_change')
                        <span class="badge  badge-log-status rounded-pill">{{ $log->action }}</span>
                    @elseif ($log->action == 'delete')
                        <span class="badge  badge-log-deleted rounded-pill">{{ $log->action }}</span>
                    @endif

                </div>

                <h1 class="h3 text-white mb-1">{{ $log->entity_type }} {{ $log->action }}</h1>
                <div class="text-muted-soft">Details of a single audit event</div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <span class="chip">
                    <i class="bi bi-calendar-event me-2"></i>{{ $log->created_at->format('d.m.Y, h:m') }}
                </span>
                <span class="chip">
                    <i class="bi bi-clock-history me-2"></i>{{ $log->created_at->diffForHumans() }}
                </span>
            </div>
        </div>

        <div class="row g-3">
            <!-- Summary -->
            <div class="col-lg-5">
                <div class="glass p-4 h-100">
                    <div class="mb-3">
                        <div class="text-muted-soft small mb-1">Actor</div>
                        <div class="d-flex align-items-start gap-3">
                            <div>
                                <div class="text-white fw-semibold">{{ $log->actor->name }}</div>
                                <div class="text-muted-soft small">{{ $log->actor->email }}</div>
                                <div class="text-muted-soft small mt-1">
                                    Role: <span
                                        class="badge bg-transparent border border-primary-subtle ">{{ $log->actor->getRole() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-3" style="border-color: rgba(255,255,255,.08);">

                    <div class="mb-3">
                        <div class="text-muted-soft small mb-1">Entity</div>
                        <div class="text-white fw-semibold">
                            {{ $log->entity_type }} #{{ $log->entity_id }}
                        </div>
                    </div>

                    <hr class="my-3" style="border-color: rgba(255,255,255,.08);">

                    <div class="mb-3">
                        <div class="text-muted-soft small mb-1">Action</div>
                        <div class="d-flex flex-wrap gap-2">
                            @if ($log->action == 'create')
                                <span class="badge badge-log-created rounded-pill">{{ $log->action }}</span>
                            @elseif ($log->action == 'update')
                                <span class="badge  badge-log-updated rounded-pill">{{ $log->action }}</span>
                            @elseif ($log->action == 'status_change')
                                <span class="badge  badge-log-status rounded-pill">{{ $log->action }}</span>
                            @elseif ($log->action == 'delete')
                                <span class="badge  badge-log-deleted rounded-pill">{{ $log->action }}</span>
                            @endif
                        </div>
                    </div>

                    <hr class="my-3" style="border-color: rgba(255,255,255,.08);">

                    <div class="mb-3">
                        <div class="text-muted-soft small mb-1">Request metadata</div>
                        <div class="text-muted-soft small">
                            IP: <span class="text-white">{{ $log->ip }}</span>
                        </div>
                        <div class="text-muted-soft small">
                            User agent:
                            <span class="d-block text-truncate" style="max-width: 260px;">
                                {{ $log->user_agent }}
                            </span>
                        </div>
                    </div>

                    <hr class="my-3" style="border-color: rgba(255,255,255,.08);">

                </div>
            </div>

            <!-- Changes -->
            <div class="col-lg-7">
                <div class="glass p-4 h-100">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <div class="text-white fw-semibold">Changes</div>
                            <div class="text-muted-soft small">Before / After for this event</div>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="glass-soft p-3 h-100">
                                <div class="text-muted-soft small mb-2">
                                    <i class="bi bi-chevron-left me-1"></i>Before
                                </div>
                                <pre class="log-json mb-0">
@if (isset($log->changes['old']))
@json($log->changes['old'], JSON_PRETTY_PRINT)
@else
{
    "null"
}
@endif
              </pre>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="glass-soft p-3 h-100">
                                <div class="text-muted-soft small mb-2">
                                    After <i class="bi bi-chevron-right ms-1"></i>
                                </div>
                                <pre class="log-json mb-0">
@if (isset($log->changes['new']))
@json($log->changes['new'], JSON_PRETTY_PRINT)
@else
{
    "null"
}
@endif
              </pre>
                            </div>
                        </div>
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

            .avatar-circle {
                width: 44px;
                height: 44px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, .08);
                border: 1px solid rgba(255, 255, 255, .10);
                color: #fff;
                font-weight: 700;
                letter-spacing: .5px;
            }

            .glass-soft {
                background: rgba(255, 255, 255, .04);
                border: 1px solid rgba(255, 255, 255, .08);
                border-radius: 14px;
                backdrop-filter: blur(8px);
            }

            .log-json {
                font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
                font-size: 0.78rem;
                color: rgba(255, 255, 255, .82);
                background: rgba(0, 0, 0, .28);
                border-radius: 10px;
                padding: 0.75rem;
                border: 1px solid rgba(255, 255, 255, .12);
                white-space: pre;
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
