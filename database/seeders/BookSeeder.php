<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::insert([
            [
                'title' => 'Harry Potter',
                'description' => 'A fantasy novel about a young wizard.',
                'price' => 150000,
                'stock' => 10,
                'cover_photo' => 'harry_potter.jpg',
                'genre_id' => 1,
                'author_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => '1984',
                'description' => 'A dystopian novel about totalitarian regime.',
                'price' => 120000,
                'stock' => 8,
                'cover_photo' => '1984.jpg',
                'genre_id' => 2,
                'author_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'The Hobbit',
                'description' => 'A fantasy adventure preceding Lord of the Rings.',
                'price' => 135000,
                'stock' => 12,
                'cover_photo' => 'the_hobbit.jpg',
                'genre_id' => 1,
                'author_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Murder on the Orient Express',
                'description' => 'A detective novel featuring Hercule Poirot.',
                'price' => 110000,
                'stock' => 7,
                'cover_photo' => 'orient_express.jpg',
                'genre_id' => 3,
                'author_id' => 4,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Kafka on the Shore',
                'description' => 'A surreal novel by Haruki Murakami.',
                'price' => 140000,
                'stock' => 9,
                'cover_photo' => 'kafka.jpg',
                'genre_id' => 1,
                'author_id' => 5,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
