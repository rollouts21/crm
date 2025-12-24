@extends('layouts.main')
@section('title')
    Create Client
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <!-- Page header -->
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 text-white mb-1">Deals</h1>
                <div class="text-muted-soft">Pipeline overview, filters and quick actions</div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('clients.index') }}" class="btn btn-primary rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i>Create Deal
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="glass p-3 mb-4">
            <form class="row g-2 align-items-end" method="GET" action="{{ route('deals.index') }}">

                <div class="col-md-3">
                    <label class="form-label text-muted-soft small">Search</label>
                    <input type="text" class="form-control search-input" value="{{ request('q') }}" name="q"
                        placeholder="Deal title or client">
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Status</label>
                    <select class="form-select search-input" name="status" style="background-color: rgba(255,255,255,.06)">
                        <option value="" class="text-black">All</option>
                        @foreach (\App\Enums\DealsStatusEnum::cases() as $status)
                            <option class="text-black" {{ request('status') == $status->value ? 'selected' : '' }}
                                value="{{ $status->value }}">{{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Amount</label>
                    <div class="d-flex gap-2">
                        <input type="number" class="form-control search-input" value="{{ request('min') }}" name="min"
                            placeholder="Min">
                        <input type="number" class="form-control search-input" value="{{ request('max') }}" name="max"
                            placeholder="Max">
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Sort</label>
                    <select class="form-select search-input" name="sort" style="background-color: rgba(255,255,255,.06)">
                        <option class="text-black" {{ request('sort') == 'updated_at' ? 'selected' : '' }}
                            value="updated_at">Updated desc</option>
                        <option class="text-black" {{ request('sort') == 'amount' ? 'selected' : '' }} value="amount">Amount
                            desc</option>
                        <option class="text-black" {{ request('sort') == 'expected_close_at' ? 'selected' : '' }}
                            value="expected_close_at">Expected close</option>
                    </select>
                </div>

                <div class="col-md-1 d-grid">
                    <button class="btn btn-soft">
                        <i class="bi bi-funnel me-1"></i>Go
                    </button>
                </div>
            </form>
        </div>

        <!-- Deals table -->
        <div class="glass p-0">
            <div class="table-responsive">
                <table class="table table-darkish table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Deal</th>
                            <th>Client</th>
                            <th class="text-nowrap">Amount</th>
                            <th>Status</th>
                            <th class="text-nowrap">Expected close</th>
                            <th class="text-nowrap">Closed at</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($deals as $deal)
                            <tr>
                                <td>
                                    <div class="fw-semibold text-white">{{ $deal->title }}</div>
                                    <div class="text-muted-soft small">Deal #{{ $deal->id }} •
                                        {{ $deal->updated_at->diffForHumans() }}</div>
                                </td>
                                <td>
                                    <a href="{{ route('clients.show', $deal->client->id) }}"
                                        class="text-white text-decoration-underline">{{ $deal->client->name }}</a>
                                    <div class="text-muted-soft small">Owner: {{ $deal->owner->name }}</div>
                                </td>
                                <td class="text-nowrap">{{ number_format($deal->amount, 2, ',', ' ') }} RUB</td>
                                <td><span
                                        class="badge {{ $deal->status->badgeClass() }} rounded-pill">{{ $deal->status->label() }}</span>
                                </td>
                                <td class="text-nowrap">{{ $deal->expected_close_at->format('m.d.Y') }}</td>
                                <td class="text-muted-soft">
                                    {{ $deal->closed_at != null ? $deal->closed_at->format('m.d.Y') : 'Not Closed' }}</td>
                                <td class="text-end">
                                    <a href="{{ route('clients.deals.show', [$deal->client->id, $deal->id]) }}"
                                        class="btn btn-sm btn-soft rounded-pill px-3">View</a>
                                    <a href="{{ route('clients.deals.edit', [$deal->client->id, $deal->id]) }}"
                                        class="btn btn-sm btn-outline-light rounded-pill px-3">Edit</a>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>

            <!-- Pagination placeholder -->
            <div class="d-flex justify-content-between align-items-center p-3">
                <div class="text-muted-soft small">{{ $deals->firstItem() ?? 0 }}-{{ $deals->lastItem() ?? 0 }} of
                    {{ $deals->total() }}</div>
                <div class="d-flex gap-2">
                    @if ($deals->onFirstPage())
                        <span class="btn btn-soft btn-sm rounded-pill disabled">Prev</span>
                    @else
                        <a class="btn btn-soft btn-sm rounded-pill" href="{{ $deals->previousPageUrl() }}">Prev</a>
                    @endif
                    @if ($deals->hasMorePages())
                        <a class="btn btn-soft btn-sm rounded-pill" href="{{ $deals->nextPageUrl() }}">Next</a>
                    @else
                        <span class="btn btn-soft btn-sm rounded-pill disabled">Next</span>
                    @endif
                </div>
            </div>
        </div>

    </main>
@endsection
