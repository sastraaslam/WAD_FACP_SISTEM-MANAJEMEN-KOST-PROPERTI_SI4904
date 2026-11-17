<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Pemilik Kos',
            'email' => 'pemilik@kos.test',
            'password' => 'password',
            'role' => 'pemilik',
        ]);

        User::create([
            'name' => 'Penghuni 1',
            'email' => 'penghuni1@kos.test',
            'password' => 'password',
            'role' => 'penghuni',
        ]);

        User::create([
            'name' => 'Penghuni 2',
            'email' => 'penghuni2@kos.test',
            'password' => 'password',
            'role' => 'penghuni',
        ]);
    }
}