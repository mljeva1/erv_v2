<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login metoda
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('home')->with('success', 'Dobrodošli, ' . Auth::user()->first_name . ' ' . Auth::user()->last_name);
        }

        return back()->withErrors([
            'email' => 'Prijava nije uspjela. Provjerite unesene podatke.',
        ]);
    }

    // Logout metoda
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
