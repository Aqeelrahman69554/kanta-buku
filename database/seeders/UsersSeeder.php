<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Akel',
                'email' => 'akel@example.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Sandi',
                'email' => 'sandi@example.com',
                'password' => Hash::make('password'),
                'role' => 'staff',
            ]
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
