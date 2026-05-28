<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Publisher;

class PublishersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Publisher::create([
            'name' => 'Penguin Random House',
            'city' => 'New York',
        ]);

        Publisher::create([
            'name' => 'HarperCollins',
            'city' => 'New York',
        ]);

        Publisher::create([
            'name' => 'Simon & Schuster',
            'city' => 'New York',
        ]);

        Publisher::create([
            'name' => 'Hachette Book Group',
            'city' => 'New York',
        ]);

        Publisher::create([
            'name' => 'Macmillan Publishers',
            'city' => 'New York',
        ]);

        Publisher::create([
            'name' => 'Scholastic Corporation',
            'city' => 'New York',
        ]);

        Publisher::create([
            'name' => 'Bloomsbury Publishing',
            'city' => 'London',
        ]);
    }
}
