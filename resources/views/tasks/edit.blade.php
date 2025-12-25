@extends('layouts.main')
@section('title')
    Edit Task
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-2">
                <a href="{{ route('tasks.index') }}" class="chip">
                    <i class="bi bi-arrow-left me-2"></i>Back to Tasks
                </a>
                <span class="chip"><i class="bi bi-pencil me-2"></i>Edit</span>
                <span class="chip"><i class="bi bi-hash me-2"></i>Task {{ $task->id }}</span>
            </div>

            <h1 class="h3 text-white mb-1">Edit Task</h1>
            <div class="text-muted-soft">Update details, status or due date</div>
        </div>

        <div class="glass p-4" style="max-width: 980px;">
            <form class="row g-3" method="POST"
                action="{{ route('clients.deals.tasks.update', [$client->id, $deal->id, $task->id]) }}">
                @csrf
                @method('PATCH')

                <div class="col-md-8">
                    <label class="form-label text-muted-soft">Title</label>
                    <input type="text" class="form-control search-input" name="title" value="{{ $task->title }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Priority</label>
                    <select class="form-select search-input" name="priority"
                        style="background-color: rgba(255,255,255,.06)">
                        @foreach (\App\Enums\TaskPriorityEnum::cases() as $priority)
                            <option class="text-black" value="{{ $priority->value }}"
                                {{ $task->priority->value == $priority->value ? 'selected' : '' }}>{{ $priority->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label text-muted-soft">Description</label>
                    <textarea class="form-control search-input" name="description" rows="4">{{ $task->description }}</textarea>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Due at</label>
                    <input type="date" class="form-control search-input" name="due_at"
                        value="{{ $task->due_at->format('Y-m-d') }}">
                    <div class="text-muted-soft small mt-1">Use local time. Overdue highlights are automatic.</div>
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Status</label>
                    <select class="form-select search-input" name="status" style="background-color: rgba(255,255,255,.06)">
                        @foreach (\App\Enums\TaskStatusEnum::cases() as $status)
                            <option class="text-black" value="{{ $status->value }}"
                                {{ $task->status->value == $status->value ? 'selected' : '' }}>
                                {{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <hr class="my-2" style="border-color: rgba(255,255,255,.08);">

                <div class="col-12 d-flex flex-wrap gap-2 mt-3">
                    <button class="btn btn-primary rounded-pill px-4" type="submit">
                        Save Changes
                    </button>

                    <a href="{{ route('tasks.index') }}" class="btn btn-soft rounded-pill px-4 ms-auto">
                        Back
                    </a>
                </div>

            </form>
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
