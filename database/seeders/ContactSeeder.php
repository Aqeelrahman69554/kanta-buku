<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID'); // Menggunakan lokalisasi Indonesia agar nama & teks terasa lokal

        // Membuat 10 data contoh untuk tabel kontak
        for ($i = 1; $i <= 10; $i++) {
            DB::table('contacts')->insert([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'pesan' => $faker->paragraph(2), // Menghasilkan teks sepanjang 2 paragraf kalimat keluhan/pesan
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
