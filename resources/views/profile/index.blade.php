@extends('layouts.main')
@section('title')
    Profile
@endsection
@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4">

        <!-- Header -->
        <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
            <div class="d-flex align-items-center gap-3">
                <div>
                    <h1 class="h3 text-white mb-1">Profile</h1>
                    <div class="text-muted-soft">
                        Manage your personal information, password and preferences
                    </div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <span class="chip">
                    <i class="bi bi-person-badge me-2"></i>Role: {{ $user->getRole() }}
                </span>
                <span class="chip">
                    <i class="bi bi-envelope me-2"></i>{{ $user->email }}
                </span>
            </div>
        </div>

        <div class="row g-3">

            <!-- Left: basic info -->
            <div class="col-lg-7">
                <div class="glass p-4 h-100">
                    <h2 class="h5 text-white mb-3">Account details</h2>

                    <form class="row g-3" method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="col-md-6">
                            <label class="form-label text-muted-soft">Name</label>
                            <input type="text" name="name" class="form-control search-input"
                                value="{{ $user->name }}">
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted-soft">Email</label>
                            <input type="email" name="email" class="form-control search-input"
                                value="{{ $user->email }}">
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>




                        <div class="col-12 d-flex gap-2 mt-2">
                            <button class="btn btn-primary rounded-pill px-4" type="submit">
                                Save changes
                            </button>
                            <button class="btn btn-soft rounded-pill px-4" type="reset">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Right: password + meta -->
            <div class="col-lg-5">
                <!-- Change password -->
                <div class="glass p-4 mb-3">
                    <h2 class="h5 text-white mb-3">Change password</h2>

                    <form class="vstack gap-3" method="POST" action="{{ route('profile.updatePass') }}">
                        @csrf
                        @method('PATCH')

                        <div>
                            <label class="form-label text-muted-soft">Current password</label>
                            <input type="password" name="current_password" class="form-control search-input">
                            @if ($errors->has('current_password'))
                                <div class="text-danger small mt-1">{{ $errors->first('current_password') }}</div>
                            @endif
                        </div>

                        <div>
                            <label class="form-label text-muted-soft">New password</label>
                            <input type="password" name="password" class="form-control search-input">
                        </div>

                        <div>
                            <label class="form-label text-muted-soft">Confirm new password</label>
                            <input type="password" name="password_confirmation" class="form-control search-input">
                        </div>

                        <button class="btn btn-outline-light rounded-pill px-4" type="submit">
                            Update password
                        </button>
                    </form>
                </div>

                <!-- Meta info -->

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

            .search-input::placeholder {
                color: rgba(255, 255, 255, .45);
            }

            .search-input:focus {
                background: rgba(255, 255, 255, .08);
                border-color: rgba(255, 255, 255, .22);
                box-shadow: 0 0 0 .2rem rgba(255, 255, 255, .08);
                color: #fff;
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

            .chip:hover {
                background: rgba(255, 255, 255, .10);
                color: #fff;
            }

            .avatar-circle-lg {
                width: 64px;
                height: 64px;
                border-radius: 20px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, .08);
                border: 1px solid rgba(255, 255, 255, .12);
                color: #fff;
                font-weight: 700;
                font-size: 1.25rem;
                letter-spacing: .06em;
                text-transform: uppercase;
            }
        </style>

    </main>
@endsection
