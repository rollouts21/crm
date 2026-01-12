{{--@extends('layouts.main')--}}

{{--@section('title')--}}
{{--    Sources--}}
{{--@endsection--}}

{{--@section('content')--}}
    <div class="row g-3">

        <div class="col-md-6">
            <label class="form-label text-muted-soft">Name</label>
            <input type="text"
                   name="name"
                   class="form-control search-input"
                   placeholder="Instagram, Website, Referral…"
                   value="">
            value="{{ old('name', $source->name ?? '') }}"
        </div>

    </div>

{{--@endsection--}}
