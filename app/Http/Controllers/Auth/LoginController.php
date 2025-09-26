<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();
            return $user->role === 'admin'
                ? redirect('/admin/dashboard')
                : redirect('/user/dashboard');
        }

        return back()->withErrors([
            'email' => 'Invalid login details.',
        ]);
    }
}
