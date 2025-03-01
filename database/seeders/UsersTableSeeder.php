<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'remember_token' => Str::random(10),
        ]);

        User::create([
            'name' => 'Supervisor',
            'email' => 'supervisor@example.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'role' => 'supervisor',
            'remember_token' => Str::random(10),
        ]);

        // tambahkan data lainnya sesuai kebutuhan
    }
}
