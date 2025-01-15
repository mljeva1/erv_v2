<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

Route::get('/hash-passwords', function () {
    // Dohvati sve korisnike iz baze direktno (bez castova)
    $users = DB::table('users')->get();

    foreach ($users as $user) {
        // Proveri da li lozinka nije već hashirana
        if (!Hash::needsRehash($user->password)) {
            // Ažuriraj lozinku direktno u bazi
            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => Hash::make($user->password)]);
        }
    }

    return "Sve lozinke su uspešno hashirane!";
});

