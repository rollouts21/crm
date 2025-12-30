@extends('layouts.main')
@section('title')
    Clients
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <!-- Page header -->
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 text-white mb-1">Clients</h1>
                <div class="text-muted-soft">Manage your leads and customers</div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('clients.create') }}" class="btn btn-primary rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i>Add Client
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="glass p-3 mb-4">
            <form class="row g-2 align-items-end" action="{{ route('clients.index') }}">
                <div class="col-md-4">
                    <label class="form-label text-muted-soft small">Search</label>
                    <input type="text" name="q" value="{{ request('q') }}" class="form-control search-input"
                        placeholder="Name, phone or email">
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Status</label>
                    <select class="form-select search-input" name="status">
                        <option class="text-black" value="">All</option>
                        @foreach (\App\Enums\ClientStatusEnum::cases() as $status)
                            <option class="text-black" {{ request('status') == $status->value ? 'selected' : '' }}
                                value="{{ $status->value }}">{{ $status->label() }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Source</label>
                    <select class="form-select search-input" name="source_id">
                        <option class="text-black" value="">Any</option>
                        @foreach ($sources as $source)
                            <option {{ request('source_id') == $source->id ? 'selected' : '' }} class="text-black"
                                value="{{ $source->id }}">{{ $source->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Sort</label>
                    <select class="form-select search-input" name="sort">
                        <option class="text-black" value="last_contact_at"
                            {{ request('sort') == 'last_contact_at' ? 'selected' : '' }}>Last contact</option>
                        <option class="text-black" value="created_at"
                            {{ request('sort') == 'created_at' ? 'selected' : '' }}>Newest</option>
                    </select>
                </div>


                <div class="col-md-2 d-grid">
                    <button class="btn btn-soft">
                        <i class="bi bi-funnel me-1"></i>Apply
                    </button>
                </div>
            </form>
        </div>

        <!-- Clients table -->
        <div class="glass p-0">
            @if ($clients->isEmpty())
                <p class="text-white text-center">Clients not found</p>
                <div class="table-responsive">
                @else
                    <table class="table table-darkish table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>Source</th>
                                <th>Deals</th>
                                <th>Last contact</th>
                                <th>Owner name</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>


                            @foreach ($clients as $client)
                                <tr>
                                    <td>
                                        <div class="fw-semibold text-white">{{ $client->name }}</div>
                                        <div class="text-muted-soft small">Company</div>
                                    </td>
                                    <td>
                                        <div>{{ $client->phone }}</div>
                                        <div class="text-muted-soft small">{{ $client->email }}</div>
                                    </td>
                                    <td>
                                        <span
                                            class="badge {{ $client->status->badgeClass() }} rounded-pill">{{ $client->status->label() }}</span>
                                    </td>
                                    <td>{{ $client->source_id }}</td>
                                    <td>{{ $client->deals->count() }}</td>
                                    <td class="text-nowrap">
                                        {{ $client->last_contact_at != null ? $client->last_contact_at->format('d.m.Y, h:m') : 'Not contacted' }}
                                    </td>
                                    <td>{{ $client->owner->name }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('clients.show', $client->id) }}"
                                            class="btn btn-sm btn-soft rounded-pill px-3">
                                            View
                                        </a>
                                        <a href="{{ route('clients.edit', $client->id) }}"
                                            class="btn btn-sm btn-outline-light rounded-pill px-3">
                                            Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <!-- Pagination placeholder -->
            {{-- <div class="d-flex justify-content-between align-items-center p-3">
                <div class="text-muted-soft small">Showing 1–2 of 24</div>
                <div>
                    <button class="btn btn-soft btn-sm rounded-pill">Prev</button>
                    <button class="btn btn-soft btn-sm rounded-pill">Next</button>
                </div>
            </div> --}}
            <div class="d-flex justify-content-between align-items-center p-3">
                <div class="text-muted-soft small">
                    Showing
                    {{ $clients->firstItem() ?? 0 }}–{{ $clients->lastItem() ?? 0 }}
                    of {{ $clients->total() }}
                </div>

                <div class="d-flex gap-2">
                    {{-- Prev --}}
                    @if ($clients->onFirstPage())
                        <span class="btn btn-soft btn-sm rounded-pill disabled">Prev</span>
                    @else
                        <a class="btn btn-soft btn-sm rounded-pill" href="{{ $clients->previousPageUrl() }}">Prev</a>
                    @endif

                    {{-- Next --}}
                    @if ($clients->hasMorePages())
                        <a class="btn btn-soft btn-sm rounded-pill" href="{{ $clients->nextPageUrl() }}">Next</a>
                    @else
                        <span class="btn btn-soft btn-sm rounded-pill disabled">Next</span>
                    @endif
                </div>
            </div>

        </div>

    </main>
@endsection
