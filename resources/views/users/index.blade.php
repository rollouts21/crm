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
                <a href="/users/create" class="btn btn-primary rounded-pill px-3">
                    <i class="bi bi-person-plus me-1"></i>Add user
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="glass p-3 mb-4">
            <form class="row g-2 align-items-end" method="GET" action="/users">
                <div class="col-md-4">
                    <label class="form-label text-muted-soft small">Search</label>
                    <input type="text" name="search" class="form-control search-input" placeholder="Name or email">
                </div>

                <div class="col-md-3">
                    <label class="form-label text-muted-soft small">Role</label>
                    <select name="role" class="form-select search-input" style="background-color: rgba(255,255,255,.06)">
                        <option value="">All</option>
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label text-muted-soft small">Status</label>
                    <select name="status" class="form-select search-input" style="background-color: rgba(255,255,255,.06)">
                        <option value="">Any</option>
                        <option value="active">Active</option>
                        <option value="disabled">Disabled</option>
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
                            <th class="text-nowrap">Last login</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle-sm">AD</div>
                                    <div>
                                        <div class="text-white fw-semibold">Admin</div>
                                        <div class="text-muted-soft small">admin@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span
                                    class="badge bg-transparent border border-warning-subtle text-warning-emphasis rounded-pill">
                                    Admin
                                </span>
                            </td>
                            <td class="text-muted-soft text-nowrap small">
                                2025-12-24 23:41<br>
                                <span class="text-success">Online</span>
                            </td>
                            <td>
                                <span
                                    class="badge bg-transparent border border-success-subtle text-success-emphasis rounded-pill">
                                    Active
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="/users/1/edit" class="btn btn-sm btn-soft rounded-pill px-3">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                                <button class="btn btn-sm btn-outline-light rounded-pill px-3" type="button">
                                    Impersonate
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle-sm">MS</div>
                                    <div>
                                        <div class="text-white fw-semibold">Manager Sales</div>
                                        <div class="text-muted-soft small">manager@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span
                                    class="badge bg-transparent border border-primary-subtle text-primary-emphasis rounded-pill">
                                    Manager
                                </span>
                            </td>
                            <td class="text-muted-soft text-nowrap small">
                                2025-12-23 18:10<br>
                                <span class="text-muted-soft">1 day ago</span>
                            </td>
                            <td>
                                <span
                                    class="badge bg-transparent border border-success-subtle text-success-emphasis rounded-pill">
                                    Active
                                </span>
                            </td>
                            <td class="text-end">
                                <a href="/users/2/edit" class="btn btn-sm btn-soft rounded-pill px-3">
                                    Edit
                                </a>
                                <button class="btn btn-sm btn-outline-danger rounded-pill px-3" type="button">
                                    Disable
                                </button>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="avatar-circle-sm">OB</div>
                                    <div>
                                        <div class="text-white fw-semibold">Old Manager</div>
                                        <div class="text-muted-soft small">old.manager@example.com</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <span
                                    class="badge bg-transparent border border-primary-subtle text-primary-emphasis rounded-pill">
                                    Manager
                                </span>
                            </td>
                            <td class="text-muted-soft text-nowrap small">
                                2025-10-01 09:00<br>
                                <span class="text-muted-soft">2 months ago</span>
                            </td>
                            <td>
                                <span
                                    class="badge bg-transparent border border-secondary-subtle text-secondary-emphasis rounded-pill">
                                    Disabled
                                </span>
                            </td>
                            <td class="text-end">
                                <button class="btn btn-sm btn-soft rounded-pill px-3" type="button">
                                    Enable
                                </button>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center p-3">
                <div class="text-muted-soft small">Showing 1–3 of 12</div>
                <div class="d-flex gap-2">
                    <button class="btn btn-soft btn-sm rounded-pill">Prev</button>
                    <button class="btn btn-soft btn-sm rounded-pill">Next</button>
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
