@extends('layouts.main')

@section('title')
    Sources
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <!-- Page header -->
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div>
                <h1 class="h3 text-white mb-1">Sources</h1>
                <div class="text-muted-soft">Manage lead sources and activation status</div>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('source.create') }}" class="btn btn-primary rounded-pill px-3">
                    <i class="bi bi-plus-lg me-1"></i>Add Source
                </a>
            </div>
        </div>


        <!-- Table -->
        <div class="glass p-0">
            <div class="table-responsive">
                <table class="table table-darkish table-hover align-middle mb-0">
                    <thead>
                    <tr>
                        <th>Source</th>
                        <th class="text-nowrap">Created</th>
                        <th class="text-end">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    <!-- Example row -->
                    @foreach($sources as $source)
                        <tr>
                            <td>
                                <div class="text-white fw-semibold">{{ $source->name }}</div>
                                <div class="text-muted-soft small">Used for DM leads</div>
                            </td>
                            <td class="text-muted-soft small text-nowrap">
                                {{ $source->created_at }}
                            </td>
                            <td class="text-end">
                                <a href="{{ route('source.edit', $source->id) }}" class="btn btn-sm btn-soft rounded-pill px-3">
                                    <i class="bi bi-pencil me-1"></i>Edit
                                </a>
                            </td>
                        </tr>
                    @endforeach



                    </tbody>
                </table>
            </div>

            <!-- Pagination -->

        </div>

        <style>
            .text-muted-soft { color: rgba(255,255,255,.62); }

            .glass{
                background: rgba(255,255,255,.06);
                border: 1px solid rgba(255,255,255,.10);
                border-radius: 18px;
                backdrop-filter: blur(10px);
            }

            .search-input{
                background: rgba(255,255,255,.06);
                border: 1px solid rgba(255,255,255,.12);
                color: rgba(255,255,255,.92);
                border-radius: 14px;
            }
            .search-input::placeholder { color: rgba(255,255,255,.45); }

            .btn-soft{
                background: rgba(255,255,255,.08);
                border: 1px solid rgba(255,255,255,.12);
                color: rgba(255,255,255,.92);
            }
            .btn-soft:hover{
                background: rgba(255,255,255,.12);
                border-color: rgba(255,255,255,.18);
                color: #fff;
            }

            .badge-active{
                background: rgba(25,135,84,.18);
                border: 1px solid rgba(25,135,84,.55);
                color: #c7f7dc;
            }
            .badge-inactive{
                background: rgba(108,117,125,.18);
                border: 1px solid rgba(108,117,125,.55);
                color: rgba(255,255,255,.72);
            }
        </style>

    </main>

@endsection
