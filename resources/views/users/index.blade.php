@extends('layouts.main')
@section('title')
    Users
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <!-- Page header -->
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 text-white mb-1">Users</h1>
                <div class="text-muted-soft">Manage access, roles and activity</div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('users.create') }}" class="btn btn-primary rounded-pill px-3">
                    <i class="bi bi-person-plus me-1"></i>Add user
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="glass p-3 mb-4">
            <form class="row g-2 align-items-end" method="GET" action="/users">
                <div class="col-md-4">
                    <label class="form-label text-muted-soft small">Search</label>
                    <input type="text" value="{{ request('q') }}" name="q" class="form-control search-input"
                        placeholder="Name or email">
                </div>

                <div class="col-md-3">
                    <label class="form-label text-muted-soft small">Role</label>
                    <select name="role_id" class="form-select search-input" style="background-color: rgba(255,255,255,.06)">
                        <option value="" class="text-black">All</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" style="text-transform: capitalize"
                                {{ request('role_id') == $role->id ? 'selected' : '' }} class="text-black">
                                {{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="col-md-2 d-grid">
                    <button class="btn btn-soft">
                        <i class="bi bi-funnel me-1"></i>Apply
                    </button>
                </div>
            </form>
        </div>

        <!-- Users table -->
        <div class="glass p-0">
            <div class="table-responsive">
                <table class="table table-darkish table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Role</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center gap-3">
                                        <div>
                                            <div class="text-white fw-semibold">{{ $user->name }}</div>
                                            <div class="text-muted-soft small">{{ $user->email }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-transparent border rounded-pill">
                                        {{ $user->getRole() }}
                                    </span>
                                </td>
                                <td class="text-end">
                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="btn btn-sm btn-soft rounded-pill px-3">
                                        <i class="bi bi-pencil me-1"></i>Edit
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center p-3">
                <div class="text-muted-soft small">
                    Showing
                    {{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}
                    of {{ $users->total() }}
                </div>

                <div class="d-flex gap-2">
                    {{-- Prev --}}
                    @if ($users->onFirstPage())
                        <span class="btn btn-soft btn-sm rounded-pill disabled">Prev</span>
                    @else
                        <a class="btn btn-soft btn-sm rounded-pill" href="{{ $users->previousPageUrl() }}">Prev</a>
                    @endif

                    {{-- Next --}}
                    @if ($users->hasMorePages())
                        <a class="btn btn-soft btn-sm rounded-pill" href="{{ $users->nextPageUrl() }}">Next</a>
                    @else
                        <span class="btn btn-soft btn-sm rounded-pill disabled">Next</span>
                    @endif
                </div>
            </div>
        </div>

        <style>
            .text-muted-soft {
                color: rgba(255, 255, 255, .62);
            }

            .glass {
                background: rgba(255, 255, 255, .06);
                border: 1px solid rgba(255, 255, 255, .10);
                border-radius: 18px;
                backdrop-filter: blur(10px);
            }

            .search-input {
                background: rgba(255, 255, 255, .06);
                border: 1px solid rgba(255, 255, 255, .12);
                color: rgba(255, 255, 255, .92);
                border-radius: 14px;
            }

            .btn-soft {
                background: rgba(255, 255, 255, .08);
                border: 1px solid rgba(255, 255, 255, .12);
                color: rgba(255, 255, 255, .92);
            }

            .btn-soft:hover {
                background: rgba(255, 255, 255, .12);
                border-color: rgba(255, 255, 255, .18);
                color: #fff;
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

            .avatar-circle-sm {
                width: 40px;
                height: 40px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, .08);
                border: 1px solid rgba(255, 255, 255, .12);
                color: #fff;
                font-weight: 600;
                font-size: 0.9rem;
                letter-spacing: .06em;
                text-transform: uppercase;
            }
        </style>

    </main>
@endsection
