<?php
namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{

    public function index(): View
    {
        return view("profile.index", ['user' => auth()->user()]);
    }

    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return redirect()->route('profile.index');
    }

    public function updatePass(): RedirectResponse
    {
        $data = request()->validate([
            'current_password' => 'required|string',
            'password'         => 'required|string|confirmed|min:8',
        ]);

        if ($data['current_password'] && ! Hash::check($data['current_password'], Auth::user()->password)) {
            return Redirect::back()->withErrors(['current_password' => 'Current password is incorrect']);
        }

        Auth::user()->update([
            'password' => Hash::make($data['password']),
        ]);
        return redirect()->route('profile.index');
    }

}
