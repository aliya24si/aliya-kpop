<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use Faker\Factory as Faker;

class PelangganSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // DATA INDONESIA

        for ($i = 0; $i < 1000; $i++) {

            $gender = $faker->randomElement(['Male', 'Female']);

            Pelanggan::create([
                'first_name' => $faker->firstName($gender === 'Male' ? 'male' : 'female'),
                'last_name'  => $faker->lastName(),
                'birthday'   => $faker->date('Y-m-d', '2010-01-01'),
                'gender'     => $gender,
                'email'      => $faker->unique()->safeEmail(),
                'phone'      => $faker->phoneNumber(),  // <-- Phone Indonesia
            ]);
        }
    }
}
