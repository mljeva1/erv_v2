<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HashUserPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:hash-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hash all plaintext passwords in the users table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            if (!Hash::needsRehash($user->password)) {
                DB::table('users')
                    ->where('id', $user->id)
                    ->update(['password' => Hash::make($user->password)]);
                $this->info("Password hashed for user: {$user->email}");
            }
        }

        $this->info('All passwords have been hashed successfully!');
    }
}
