@extends('layouts.main')

@section('title')
    Edit Client
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <div class="mb-4">
            <h1 class="h3 text-white mb-1">Edit Client</h1>
            <div class="text-muted-soft">Update client information</div>
        </div>

        <div class="glass p-4" style="max-width: 900px;">
            <form class="row g-3">

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Name</label>
                    <input type="text" class="form-control search-input" value="Coffee House">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Phone</label>
                    <input type="text" class="form-control search-input" value="+1 234 567 89">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Email</label>
                    <input type="email" class="form-control search-input" value="coffee@mail.com">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">City</label>
                    <input type="text" class="form-control search-input" value="New York">
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Source</label>
                    <select class="form-select search-input">
                        <option selected>Instagram</option>
                        <option>Website</option>
                        <option>Referral</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Status</label>
                    <select class="form-select search-input">
                        <option>New</option>
                        <option selected>Qualified</option>
                        <option>VIP</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Owner</label>
                    <select class="form-select search-input">
                        <option selected>Admin</option>
                        <option>Manager</option>
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label text-muted-soft">Note</label>
                    <textarea rows="4" class="form-control search-input">
Regular customer, prefers email contact.
        </textarea>
                </div>

                <div class="col-12 d-flex gap-2 mt-3">
                    <button class="btn btn-primary rounded-pill px-4">
                        Update Client
                    </button>
                    <a href="/clients" class="btn btn-soft rounded-pill px-4">
                        Cancel
                    </a>
                </div>

            </form>
        </div>

    </main>
@endsection
