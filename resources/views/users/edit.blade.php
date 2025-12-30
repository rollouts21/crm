@extends('layouts.main')
@section('title')
    Edit User
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <div class="mb-4">
            <div class="d-flex align-items-center gap-2 mb-2">
                <a href="/users" class="chip">
                    <i class="bi bi-arrow-left me-2"></i>Back to Users
                </a>
                <span class="chip">
                    <i class="bi bi-person me-2"></i>User #2
                </span>
            </div>

            <h1 class="h3 text-white mb-1">Edit user</h1>
            <div class="text-muted-soft">Update role, status and basic information</div>
        </div>

        <div class="glass p-4" style="max-width: 900px;">
            <form class="row g-3" method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PATCH')

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Name</label>
                    <input type="text" name="name" class="form-control search-input" value="{{ $user->name }}">
                </div>

                <div class="col-md-6">
                    <label class="form-label text-muted-soft">Email</label>
                    <input type="email" name="email" class="form-control search-input" value="{{ $user->email }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label text-muted-soft">Role</label>
                    <select name="role" class="form-select search-input" style="background-color: rgba(255,255,255,.06)">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->role->id == $role->id ? 'selected' : '' }}
                                class="text-black">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>



                <div class="col-12 d-flex flex-wrap gap-2 mt-3">
                    <button class="btn btn-primary rounded-pill px-4" type="submit">
                        Save changes
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-soft rounded-pill px-4">
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
