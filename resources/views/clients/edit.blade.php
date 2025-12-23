@extends('layouts.main')

@section('title')
    Edit {{ $client->name }}
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <div class="mb-4">
            <h1 class="h3 text-white mb-1">Edit Client</h1>
            <div class="text-muted-soft">Update client information</div>
        </div>

        <div class="glass p-4" style="max-width: 900px;">
            <form class="row g-3" action="{{ route('clients.update', $client->id) }}" method="post">
                @csrf
                @method('patch')

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Name</label>
                    <input type="text" class="form-control search-input" name="name" value="{{ $client->name }}"
                        placeholder="Client name">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Phone</label>
                    <input type="text" class="form-control search-input" name="phone" value="{{ $client->phone }}"
                        placeholder="+1 234 567 89">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Email</label>
                    <input type="email" class="form-control search-input" value="{{ $client->email }}" name="email"
                        placeholder="email@example.com">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">City</label>
                    <input type="text" class="form-control search-input" name="city" value="{{ $client->city }}"
                        placeholder="New York">
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Source</label>
                    <select class="form-select search-input" name="source_id">
                        @foreach ($sources as $source)
                            <option class="text-black" {{ $client->source_id == $source->id ? 'selected' : '' }}
                                value="{{ $source->id }}">{{ $source->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Status</label>
                    <select class="form-select search-input" style="background-color: rgba(255, 255, 255, .06)"
                        name="status">
                        @foreach (App\Enums\ClientStatusEnum::cases() as $status)
                            <option style="color: black" {{ $client->status->value == $status->value ? 'selected' : '' }}
                                value="{{ $status->value }}">
                                {{ $status->label() }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12">
                    <label class="form-label text-muted-soft">Note</label>
                    <textarea rows="4" class="form-control search-input" name="note" placeholder="Additional information...">{{ $client->note }}</textarea>
                </div>

                <div class="col-12 d-flex gap-2 mt-3">
                    <button class="btn btn-primary rounded-pill px-4">
                        Update Client
                    </button>
                    <a href="{{ route('clients.index') }}" class="btn btn-soft rounded-pill px-4">
                        Cancel
                    </a>
                </div>

            </form>
        </div>

    </main>
@endsection
