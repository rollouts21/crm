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
        <form class="row g-3" method="POST" action="/users/2">
            <!-- @csrf -->
            <!-- @method('PATCH') -->

            <div class="col-md-6">
                <label class="form-label text-muted-soft">Name</label>
                <input type="text" name="name" class="form-control search-input" value="Manager Sales">
            </div>

            <div class="col-md-6">
                <label class="form-label text-muted-soft">Email</label>
                <input type="email" name="email" class="form-control search-input" value="manager@example.com">
            </div>

            <div class="col-md-4">
                <label class="form-label text-muted-soft">Role</label>
                <select name="role" class="form-select search-input" style="background-color: rgba(255,255,255,.06)">
                    <option value="manager" selected>Manager</option>
                    <option value="admin">Admin</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label text-muted-soft">Status</label>
                <select name="status" class="form-select search-input" style="background-color: rgba(255,255,255,.06)">
                    <option value="active" selected>Active</option>
                    <option value="disabled">Disabled</option>
                </select>
            </div>

            <div class="col-md-4">
                <label class="form-label text-muted-soft">Force password reset</label>
                <select name="force_password_reset" class="form-select search-input"
                    style="background-color: rgba(255,255,255,.06)">
                    <option value="0" selected>No</option>
                    <option value="1">On next login</option>
                </select>
            </div>

            <div class="col-12">
                <label class="form-label text-muted-soft">Internal note</label>
                <textarea name="note" rows="3" class="form-control search-input" placeholder="Optional note for admins">Top-performing manager for web leads.</textarea>
            </div>

            <div class="col-12 d-flex flex-wrap gap-2 mt-3">
                <button class="btn btn-primary rounded-pill px-4" type="submit">
                    Save changes
                </button>
                <a href="/users" class="btn btn-soft rounded-pill px-4">
                    Cancel
                </a>

                <div class="ms-lg-auto d-flex flex-wrap gap-2">
                    <button class="btn btn-outline-danger rounded-pill px-4" type="button">
                        Disable account
                    </button>
                    <button class="btn btn-outline-light rounded-pill px-4" type="button">
                        Send password reset link
                    </button>
                </div>
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
