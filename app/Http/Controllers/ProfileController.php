<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function edit(Request $request)
    {
        return inertia('Profile/Edit', [
            'user' => $request->user(),
            'status' => session('status'),
        ]);
    }
    public function updateInfo(Request $request)
    {
        $field = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($request->user()->id)
            ],
        ]);
        $request->user()->fill($field);
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
            // This will require the user to verify their email again
        }
        $request->user()->save();

        return redirect()->route('profile.edit');
    }
    public function updatePassword(Request $request)
    {
        $field = $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request->user()->update(([
            'password' => Hash::make($field['password'])
        ]));
        return redirect()->route('profile.edit');
    }
    public function destroy(Request $request)
    {
        $field = $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout(); // Log out the user before deleting
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
