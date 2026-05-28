<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $authors = [
            [
                'name' => 'J.K. Rowling',
                'biography' => 'J.K. Rowling is a British author best known for writing the Harry Potter fantasy series.',
                'image' => 'jk_rowling.jpg',
            ],
            [
                'name' => 'George R.R. Martin',
                'biography' => 'George R.R. Martin is an American novelist and short story writer, best known for his series of epic fantasy novels, A Song of Ice and Fire.',
                'image' => 'george_rr_martin.jpg',
            ],
            [
                'name' => 'Agatha Christie',
                'biography' => 'Agatha Christie was an English writer known for her 66 detective novels and 14 short story collections, particularly those revolving around her fictional detectives Hercule Poirot and Miss Marple.',
                'image' => 'agatha_christie.jpg',
            ],
            [
                'name' => 'Stephen King',
                'biography' => 'Stephen King is an American author of horror, supernatural fiction, suspense, crime, science-fiction, and fantasy novels.',
                'image' => 'stephen_king.jpg',
            ],
            [
                'name' => 'Jane Austen',
                'biography' => 'Jane Austen was an English novelist known primarily for her six major novels, which interpret, critique and comment upon the British landed gentry at the end of the 18th century.',
                'image' => 'jane_austen.jpg',
            ],
            [
                'name' => 'Mark Twain',
                'biography' => 'Mark Twain was an American writer, humorist, entrepreneur, publisher, and lecturer. He is best known for his novels The Adventures of Tom Sawyer and Adventures of Huckleberry Finn.',
                'image' => 'mark_twain.jpg',
            ],
            [
                'name' => 'Ernest Hemingway',
                'biography' => 'Ernest Hemingway was an American novelist, short-story writer, journalist, and sportsman. His economical and understated style had a strong influence on 20th-century fiction.',
                'image' => 'ernest_hemingway.jpg',
            ],
            [
                'name' => 'F. Scott Fitzgerald',
                'biography' => 'F. Scott Fitzgerald was an American novelist, essayist, screenwriter, and short-story writer, widely regarded as one of the greatest American writers of the 20th century.',
                'image' => 'f_scott_fitzgerald.jpg',
            ],
            [
                'name' => 'Haruki Murakami',
                'biography' => 'Haruki Murakami is a Japanese writer known for his works of fiction and non-fiction, including novels, short stories, and essays.',
                'image' => 'haruki_murakami.jpg',
            ],
            [
                'name' => 'Isabel Allende',
                'biography' => 'Isabel Allende is a Chilean writer whose works sometimes contain aspects of the genre of magical realism.',
                'image' => 'isabel_allende.jpg',
            ],

        ];

        foreach ($authors as $author) {
            Author::create($author);
        }
    }
}
