<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => 'required'
        ]);

        $user = User::first();

        if ($user && Hash::check($request->string('password')->value(), $user->password)) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/dashboard');
        }

        return back()->withErrors([
            'password' => 'The password is incorrect.',
        ]);
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}