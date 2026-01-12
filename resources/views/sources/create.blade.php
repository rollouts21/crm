@extends('layouts.main')

@section('title')
    Sources
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-2">
                <a href="/sources" class="chip">
                    <i class="bi bi-arrow-left me-2"></i>Back to Sources
                </a>
                <span class="chip">
        <i class="bi bi-plus-circle me-2"></i>New source
      </span>
            </div>

            <h1 class="h3 text-white mb-1">Create Source</h1>
            <div class="text-muted-soft">Add a new lead source for clients</div>
        </div>

        <div class="glass p-4" style="max-width: 900px;">
            <form method="POST" action="{{ route('source.store') }}" class="vstack gap-3">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label text-muted-soft">Name</label>
                        <input type="text"
                               name="name"
                               class="form-control search-input"
                               placeholder="Instagram, Website, Referral…"
                                 value="{{ old('name', $source->name ?? '') }}">

                    </div>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button class="btn btn-primary rounded-pill px-4" type="submit">
                        Create
                    </button>
                    <a href="{{ route('source.index') }}" class="btn btn-soft rounded-pill px-4">
                        Cancel
                    </a>
                </div>
            </form>
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
        </style>

    </main>

@endsection
