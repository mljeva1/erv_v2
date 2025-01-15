<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class HashUserPasswords extends Command
{
    protected $signature = 'users:hash-passwords';
    protected $description = 'Hashira sve nehashirane lozinke u bazi';

    public function handle()
    {   
        $users = User::all();
        foreach ($users as $user) {
            if (\Illuminate\Support\Facades\Hash::needsRehash($user->password)) {
                $originalPassword = $user->password; // Sačuvajte originalnu lozinku za proveru
                $user->password = $user->password;  // Setter automatski hashira
                $user->save();
        
                $this->info("Lozinka za korisnika {$user->email} je uspešno hashirana. Originalna lozinka: {$originalPassword}");
            } else {
                $this->info("Lozinka za korisnika {$user->email} je već hashirana.");
            }
        }
        
}}