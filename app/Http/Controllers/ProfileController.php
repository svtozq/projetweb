<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserSchool;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    public function edit(Request $request): View {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    public function update(Request $request, User $user): RedirectResponse {
        // Verify inputs requirements
        $request->validate([
            'email' => ['sometimes', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'current_password' => ['required_with:password', 'current_password'],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed'],
        ]);

        // If email input is filled update email row
        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        // If password input is filled update password row
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // Only update email & password rows, then save
        $user->fill($request->only(['email', 'password']));
        $user->save();

        return redirect()->back();
    }

    public function delete(Request $request): RedirectResponse {
        // Verify inputs requirements
        $request->validateWithBag('userDeletion',[
            'delete' => ['required', 'accepted'],
            'password' => ['required', 'current_password'],
        ]);

        // Get the logged-in user
        $user = $request->user();

        // Log out user
        Auth::logout();

        // Delete user in users & users_school table
        $user->delete();
        UserSchool::find($user->id)->delete();

        // Security preventions after deletion
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
