@extends('layouts.main')
@section('title')
    Create Task
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-2">
                <a href="/tasks" class="chip">
                    <i class="bi bi-arrow-left me-2"></i>Back to Tasks
                </a>
                <span class="chip"><i class="bi bi-plus-lg me-2"></i>New task</span>
            </div>

            <h1 class="h3 text-white mb-1">Create Task</h1>
            <div class="text-muted-soft">Add a follow-up with due date and priority</div>
        </div>

        <div class="glass p-4" style="max-width: 980px;">
            <form class="row g-3" method="post"
                action="{{ route('clients.deals.tasks.store', [$client->id, $deal->id]) }}">
                @csrf
                <div class="col-md-8">
                    <label class="form-label text-muted-soft">Title</label>
                    <input type="text" class="form-control search-input" name="title"
                        placeholder="e.g., Call client to confirm details">
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Priority</label>
                    <select class="form-select search-input" name="priority"
                        style="background-color: rgba(255,255,255,.06)">
                        @foreach (\App\Enums\TaskPriorityEnum::cases() as $priority)
                            <option value="{{ $priority->value }}" class="text-black">{{ $priority->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label text-muted-soft">Description (optional)</label>
                    <textarea class="form-control search-input" name="description" rows="4"
                        placeholder="Context, details, next steps..."></textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Due at</label>
                    <input type="date" class="form-control search-input" name="due_at">
                    <div class="text-muted-soft small mt-1">Overdue tasks will be highlighted automatically.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Status</label>
                    <select class="form-select search-input" name="status" style="background-color: rgba(255,255,255,.06)">
                        @foreach (\App\Enums\TaskStatusEnum::cases() as $status)
                            <option value="{{ $status->value }}" class="text-black">{{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <hr class="my-2" style="border-color: rgba(255,255,255,.08);">

                <div class="col-12 d-flex gap-2 mt-3">
                    <button class="btn btn-primary rounded-pill px-4" type="submit">
                        Save Task
                    </button>
                    <a href="/tasks" class="btn btn-soft rounded-pill px-4">
                        Cancel
                    </a>
                </div>

            </form>
        </div>

        <style>
            .badge-outline-info {
                border: 1px solid rgba(13, 202, 240, .45);
                color: rgba(255, 255, 255, .90);
                background: rgba(13, 202, 240, .12);
            }

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
