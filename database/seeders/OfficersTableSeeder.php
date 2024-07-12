<?php

namespace Database\Seeders;

use App\Models\Officer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OfficersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Officer::create([
            'name' => 'John Doe',
            'nip' => '12345',
            'email' => 'john.doe@example.com',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10),
        ]);
    }
}
