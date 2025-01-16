<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

    // Prikaz registracijske forme
    public function showRegistrationForm()
    {
        $sectionRooms = \App\Models\SectionRoom::all(); // Pretpostavljam da imaš model SectionRoom
        return view('auth.register', compact('sectionRooms'));
    }

    // Obrada registracije
    public function register(Request $request)
    {
        // Validacija ulaznih podataka
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|max:255',
            'section_room_id' => 'required|integer|exists:section_rooms,id',
        ]);

        // Kreiranje novog korisnika
       $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Lozinka se hashira ovde
            'role_id' => 2, // Podrazumevana rola
            'section_room_id' => $request->section_room_id,
        ]);

        // Automatsko prijavljivanje nakon registracije
        Auth::login($user);

        // Redirekcija na početnu stranicu
        return redirect()->route('home')->with('success', 'Registracija uspješna! Dobrodošli, ' . $user->first_name . '!');
    }
}
