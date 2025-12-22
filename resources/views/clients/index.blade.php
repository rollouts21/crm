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
                <a href="/clients/create" class="btn btn-primary rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i>Add Client
                </a>
            </div>
        </div>

        <!-- Filters -->
        <div class="glass p-3 mb-4">
            <form class="row g-2 align-items-end">
                <div class="col-md-4">
                    <label class="form-label text-muted-soft small">Search</label>
                    <input type="text" class="form-control search-input" placeholder="Name, phone or email">
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Status</label>
                    <select class="form-select search-input">
                        <option value="">All</option>
                        <option>New</option>
                        <option>Contacted</option>
                        <option>Qualified</option>
                        <option>VIP</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Source</label>
                    <select class="form-select search-input">
                        <option value="">Any</option>
                        <option>Instagram</option>
                        <option>Website</option>
                        <option>Referral</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label text-muted-soft small">Sort</label>
                    <select class="form-select search-input">
                        <option>Last contact</option>
                        <option>Newest</option>
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
            <div class="table-responsive">
                <table class="table table-darkish table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Client</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Source</th>
                            <th>Deals</th>
                            <th>Last contact</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>
                                <div class="fw-semibold text-white">Coffee House</div>
                                <div class="text-muted-soft small">Company</div>
                            </td>
                            <td>
                                <div>+1 234 567 89</div>
                                <div class="text-muted-soft small">coffee@mail.com</div>
                            </td>
                            <td>
                                <span class="badge text-bg-success rounded-pill">Qualified</span>
                            </td>
                            <td>Instagram</td>
                            <td>3</td>
                            <td class="text-nowrap">Today</td>
                            <td class="text-end">
                                <a href="/clients/1" class="btn btn-sm btn-soft rounded-pill px-3">
                                    View
                                </a>
                                <a href="/clients/1/edit" class="btn btn-sm btn-outline-light rounded-pill px-3">
                                    Edit
                                </a>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <div class="fw-semibold text-white">John Smith</div>
                                <div class="text-muted-soft small">Individual</div>
                            </td>
                            <td>
                                <div>+1 987 654 32</div>
                            </td>
                            <td>
                                <span class="badge text-bg-secondary rounded-pill">New</span>
                            </td>
                            <td>Website</td>
                            <td>0</td>
                            <td class="text-nowrap text-muted-soft">—</td>
                            <td class="text-end">
                                <a href="/clients/2" class="btn btn-sm btn-soft rounded-pill px-3">
                                    View
                                </a>
                                <a href="/clients/2/edit" class="btn btn-sm btn-outline-light rounded-pill px-3">
                                    Edit
                                </a>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>

            <!-- Pagination placeholder -->
            <div class="d-flex justify-content-between align-items-center p-3">
                <div class="text-muted-soft small">Showing 1–2 of 24</div>
                <div>
                    <button class="btn btn-soft btn-sm rounded-pill">Prev</button>
                    <button class="btn btn-soft btn-sm rounded-pill">Next</button>
                </div>
            </div>
        </div>

    </main>
@endsection
