@extends('layouts.main')
@section('title')
    Login
@endsection

@section('content')
    <main class="container-fluid px-3 px-lg-4 py-4 d-flex align-items-center justify-content-center"
        style="min-height: 85vh;">

        <div class="w-100" style="max-width: 980px;">
            <div class="row g-3 align-items-stretch">

                <!-- Left: branding / pitch -->
                <div class="col-lg-6">
                    <div class="glass p-4 p-lg-5 h-100">
                        <div class="d-flex align-items-center gap-2 mb-4">
                            <div class="brand-mark">
                                <i class="bi bi-grid-1x2-fill"></i>
                            </div>
                            <div>
                                <div class="text-white fw-semibold">Mini-CRM</div>
                                <div class="text-muted-soft small">Clients • Deals • Tasks • Logs</div>
                            </div>
                        </div>

                        <h1 class="display-6 text-white fw-semibold mb-3" style="letter-spacing: -0.02em;">
                            Welcome back
                        </h1>
                        <p class="text-muted-soft mb-4">
                            Sign in to manage your pipeline, track follow-ups, and keep an audit trail of every change.
                        </p>

                        <div class="d-grid gap-2">
                            <div class="glass-soft p-3">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="icon-pill"><i class="bi bi-check2-square"></i></div>
                                    <div>
                                        <div class="text-white fw-semibold">Stay on top of tasks</div>
                                        <div class="text-muted-soft small">Today, overdue, and upcoming views.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="glass-soft p-3">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="icon-pill"><i class="bi bi-activity"></i></div>
                                    <div>
                                        <div class="text-white fw-semibold">Audit & accountability</div>
                                        <div class="text-muted-soft small">See who changed what, and when.</div>
                                    </div>
                                </div>
                            </div>

                            <div class="glass-soft p-3">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="icon-pill"><i class="bi bi-graph-up"></i></div>
                                    <div>
                                        <div class="text-white fw-semibold">Simple analytics</div>
                                        <div class="text-muted-soft small">Pipeline health and source performance.</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4" style="border-color: rgba(255,255,255,.08);">

                        <div class="text-muted-soft small">
                            Tip: Use demo accounts in README for quick preview.
                        </div>
                    </div>
                </div>

                <!-- Right: login form -->
                <div class="col-lg-6">
                    <div class="glass p-4 p-lg-5 h-100">

                        <div class="mb-4">
                            <h2 class="h4 text-white mb-1">Sign in</h2>
                            <div class="text-muted-soft">Enter your credentials to continue</div>
                        </div>

                        <!-- Alerts placeholder -->
                        <div class="alert alert-danger d-none" role="alert">
                            Invalid credentials. Please try again.
                        </div>

                        <form method="POST" action="{{ route('login') }}" class="vstack gap-3">
                            @csrf

                            <div>
                                <label class="form-label text-muted-soft">Email</label>
                                <div class="input-group input-group-glass">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" name="email" class="form-control search-input"
                                        placeholder="email@example.com" autocomplete="email" required>
                                </div>
                                <!-- error placeholder -->
                                <div class="text-danger small mt-1 d-none">Email is required</div>
                            </div>

                            <div>
                                <label class="form-label text-muted-soft">Password</label>
                                <div class="input-group input-group-glass">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" name="password" class="form-control search-input"
                                        placeholder="Your password" autocomplete="current-password" required>
                                    <button class="btn btn-soft px-3" type="button" aria-label="Show password">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </div>
                                <!-- error placeholder -->
                                <div class="text-danger small mt-1 d-none">Password is required</div>
                            </div>

                            <div class="d-flex align-items-center justify-content-between">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label text-muted-soft" for="remember">
                                        Remember me
                                    </label>
                                </div>

                                <a href="/forgot-password" class="link-soft small">Forgot password?</a>
                            </div>

                            <button class="btn btn-primary rounded-pill py-2 fw-semibold" type="submit">
                                Sign in
                            </button>

                            <div class="text-center text-muted-soft small">
                                Don’t have an account?
                                <a class="link-soft" href="/register">Create one</a>
                            </div>

                            <!-- Demo credentials (optional) -->
                            <div class="glass-soft p-3 mt-2">
                                <div class="d-flex align-items-start gap-3">
                                    <div class="icon-pill"><i class="bi bi-info-circle"></i></div>
                                    <div>
                                        <div class="text-white fw-semibold">Demo</div>
                                        <div class="text-muted-soft small">
                                            admin@example.com / password<br>
                                            manager@example.com / password
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

        <style>
            /* Keep/remove depending on your global CSS */
            .text-muted-soft {
                color: rgba(255, 255, 255, .62);
            }

            .glass {
                background: rgba(255, 255, 255, .06);
                border: 1px solid rgba(255, 255, 255, .10);
                border-radius: 18px;
                backdrop-filter: blur(10px);
            }

            .glass-soft {
                background: rgba(255, 255, 255, .04);
                border: 1px solid rgba(255, 255, 255, .08);
                border-radius: 16px;
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

            .link-soft {
                color: rgba(255, 255, 255, .78);
                text-decoration: none;
                border-bottom: 1px dashed rgba(255, 255, 255, .25);
                padding-bottom: 2px;
            }

            .link-soft:hover {
                color: #fff;
                border-bottom-color: rgba(255, 255, 255, .45);
            }

            .brand-mark {
                width: 42px;
                height: 42px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, .08);
                border: 1px solid rgba(255, 255, 255, .12);
                color: #fff;
            }

            .icon-pill {
                width: 36px;
                height: 36px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(255, 255, 255, .08);
                border: 1px solid rgba(255, 255, 255, .10);
                color: #fff;
                flex: 0 0 auto;
            }

            .input-group-glass .input-group-text {
                background: rgba(255, 255, 255, .06);
                border: 1px solid rgba(255, 255, 255, .12);
                color: rgba(255, 255, 255, .80);
                border-radius: 14px 0 0 14px;
            }

            .input-group-glass .form-control {
                border-left: 0;
                border-right: 0;
                border-radius: 0;
            }

            .input-group-glass .btn {
                border-radius: 0 14px 14px 0;
            }

            .form-check-input {
                background-color: rgba(255, 255, 255, .08);
                border-color: rgba(255, 255, 255, .18);
            }

            .form-check-input:checked {
                background-color: rgba(13, 110, 253, .9);
                border-color: rgba(13, 110, 253, .9);
            }
        </style>

    </main>
@endsection
