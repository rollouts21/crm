<?php
namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\QueryFilters\UserFilters;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        $filters = request()->validate([
            'q'       => 'nullable',
            'role_id' => 'nullable',
        ]);
        $users = User::query()->with('role');
        $users = app(UserFilters::class)->apply($users, $filters);
        return view('users.index', ['users' => $users->paginate(10)->withQueryString(), 'roles' => Role::all()]);
    }

    public function edit(User $user): View
    {
        return view('users.edit', ['user' => $user, 'roles' => Role::all()]);
    }

    public function update(User $user): RedirectResponse
    {
        $data = request()->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'role'  => 'required|exists:roles,id',
        ]);

        $user->update([
            'name'    => $data['name'],
            'email'   => $data['email'],
            'role_id' => $data['role'],
        ]);

        return redirect()->route('users.index');
    }

    public function create(): View
    {
        return view('users.create', ['roles' => Role::all()]);
    }

    public function store()
    {
        $data = request()->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|max:255|unique:users,email',
            'role'     => 'required|exists:roles,id',
            'password' => 'required|string|min:8',
        ]);

        User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role_id'  => $data['role'],
            'password' => bcrypt($data['password']),
        ]);

        return redirect()->route('users.index');
    }
}
