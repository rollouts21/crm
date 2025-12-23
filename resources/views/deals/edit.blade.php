@extends('layouts.main')
@section('title')
    Create Client
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-2">
                <a href="/deals/152" class="chip">
                    <i class="bi bi-arrow-left me-2"></i>Back to Deal
                </a>
                <span class="chip"><i class="bi bi-hash me-2"></i>Deal #152</span>
            </div>

            <h1 class="h3 text-white mb-1">Edit Deal</h1>
            <div class="text-muted-soft">Update basic information (some fields may be locked after closing)</div>
        </div>

        <div class="glass p-4" style="max-width: 980px;">
            <form class="row g-3" method="POST" action="/deals/152">
                <!-- @csrf -->
                <!-- @method('PATCH') -->

                <div class="col-md-8">
                    <label class="form-label text-muted-soft">Title</label>
                    <input type="text" class="form-control search-input" name="title" value="Website redesign">
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Status</label>
                    <select class="form-select search-input" name="status" style="background-color: rgba(255,255,255,.06)">
                        <option value="new">New</option>
                        <option value="in_progress" selected>In progress</option>
                        <option value="won">Won</option>
                        <option value="lost">Lost</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Amount</label>
                    <input type="number" class="form-control search-input" name="amount" value="2500">
                    <div class="text-muted-soft small mt-1">This can be locked for managers if deal is closed.</div>
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Currency</label>
                    <select class="form-select search-input" name="currency"
                        style="background-color: rgba(255,255,255,.06)">
                        <option selected>EUR</option>
                        <option>USD</option>
                        <option>RUB</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Expected close</label>
                    <input type="date" class="form-control search-input" name="expected_close_at" value="2026-01-10">
                </div>

                <div class="col-12">
                    <label class="form-label text-muted-soft">Comment</label>
                    <textarea class="form-control search-input" name="comment" rows="4">Client requested 2 design variants and timeline estimate.</textarea>
                </div>

                <div class="col-12 d-flex gap-2 mt-3">
                    <button class="btn btn-primary rounded-pill px-4" type="submit">Update Deal</button>
                    <a href="/deals/152" class="btn btn-soft rounded-pill px-4">Cancel</a>
                </div>
            </form>
        </div>

    </main>
@endsection
