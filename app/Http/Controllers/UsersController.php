<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;

class UsersController extends Controller
{
    public function index(): Response
    {
        $users = User::all();
        $users = UserResource::collection($users)->resolve();

        return Inertia::render('Users/Index', ['users' => $users]);
    }

    public function create(): Response
    {
        $roles = User::getRoles();
        return Inertia::render('Users/Create', ['roles' => $roles]);
    }

    public function edit(UpdateRequest $request, User $user): Response
    {
        return Inertia::render('Users/Edit');
    }

    public function update(UpdateRequest $request, User $user): RedirectResponse
    {
        $user->update($request->validated());
        return redirect()->route('users.index');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $role = $data['role'];
        if ($role == "Admin") {
            $data['role'] = 1;
        } else {
            $data['role'] = 0;
        }
        $pass = Hash::make($data['password']);
//        dd($pass);
        $data['password'] = $pass;
        User::create($data);
        return redirect()->route('users.index');
    }
}
