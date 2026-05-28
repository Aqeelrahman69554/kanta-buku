<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fiction', 'slug' => 'fiction'],
            ['name' => 'Non-Fiction', 'slug' => 'non-fiction'],
            ['name' => 'Science Fiction', 'slug' => 'science-fiction'],
            ['name' => 'Fantasy', 'slug' => 'fantasy'],
            ['name' => 'Mystery', 'slug' => 'mystery'],
            ['name' => 'Biography', 'slug' => 'biography'],
            ['name' => 'History', 'slug' => 'history'],
            ['name' => 'Children\'s Books', 'slug' => 'childrens-books'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
