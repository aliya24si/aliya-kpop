<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID'); // <-- WAJIB!

        // Daftar role yang valid
        $roles = ['admin', 'staff', 'user'];

        // --- Data Administrator Khusus (Wajib Ada) ---
        // Buat satu akun admin khusus untuk login
        User::create([
            'name'      => 'Admin Utama',
            'email'     => 'admin@example.com',
            'role'      => 'admin', // Role khusus: admin
            'password'  => Hash::make('password'),
        ]);

        // --- Data Dummy Massal (1000 users) ---
        for ($i = 0; $i < 1000; $i++) {
            User::create([
                'name'      => $faker->name,
                'email'     => $faker->unique()->safeEmail,
                // Mengambil role secara acak dari array $roles
                'role'      => $faker->randomElement($roles),
                'password'  => Hash::make('password'),
            ]);
        }
    }
}
