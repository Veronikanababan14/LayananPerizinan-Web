<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create(
            ['email' => 'admin@bpbatam.go.id'], // email unik
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'), // ganti dengan password yang aman
                'role' => 'admin', // pastikan tabel users ada kolom 'role'
            ]
        );
    }
}
