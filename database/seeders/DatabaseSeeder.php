<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Akun Admin default
        User::updateOrCreate(
            ['username' => 'admin'],
            ['password' => 'admin123', 'role' => 'admin']
        );

        // Akun Peserta contoh
        User::updateOrCreate(
            ['username' => 'peserta1'],
            ['password' => 'peserta123', 'role' => 'peserta']
        );

        $this->call([
            EventSeeder::class,
        ]);
    }
}
