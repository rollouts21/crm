@extends('layouts.main')
@section('title')
    Create Client
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-2">
                <a href="{{ route('clients.show', $client->id) }}" class="chip">
                    <i class="bi bi-arrow-left me-2"></i>Back to Client
                </a>
                <span class="chip"><i class="bi bi-person me-2"></i>Client: {{ $client->name }}</span>
            </div>

            <h1 class="h3 text-white mb-1">Create Deal</h1>
            <div class="text-muted-soft">Add a new deal to the pipeline</div>
        </div>

        <div class="glass p-4" style="max-width: 980px;">
            <form class="row g-3" method="POST" action="{{ route('clients.deals.store', $client->id) }}">
                @csrf

                <div class="col-md-8">
                    <label class="form-label text-muted-soft">Title</label>
                    <input type="text" class="form-control search-input" name="title"
                        placeholder="e.g., Website redesign">
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Status</label>
                    <select class="form-select search-input" name="status" style="background-color: rgba(255,255,255,.06)">
                        @foreach (\App\Enums\ClientStatusEnum::cases() as $status)
                            <option class="text-black" value="{{ $status->value }}">{{ $status->label() }}</option>
                        @endforeach
                    </select>
                    <div class="text-muted-soft small mt-1">Tip: set Won/Lost from the deal page (with rules).</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Amount</label>
                    <input type="number" class="form-control search-input" name="amount" placeholder="2500">
                </div>


                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Expected close</label>
                    <input type="date" class="form-control search-input" name="expected_close_at">
                </div>

                <div class="col-12">
                    <label class="form-label text-muted-soft">Comment</label>
                    <textarea class="form-control search-input" name="comment" rows="4"
                        placeholder="Any context, constraints, notes..."></textarea>
                </div>

                <div class="col-12 d-flex gap-2 mt-3">
                    <button class="btn btn-primary rounded-pill px-4" type="submit">Save Deal</button>
                    <a href="/clients/88" class="btn btn-soft rounded-pill px-4">Cancel</a>
                </div>
            </form>
        </div>

    </main>
@endsection
