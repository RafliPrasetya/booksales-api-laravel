<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Book;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        Book::insert([
            ['title' => 'Harry Potter', 'year' => 1997, 'author_id' => 1],
            ['title' => '1984', 'year' => 1949, 'author_id' => 2],
            ['title' => 'The Hobbit', 'year' => 1937, 'author_id' => 3],
            ['title' => 'Murder on the Orient Express', 'year' => 1934, 'author_id' => 4],
            ['title' => 'Kafka on the Shore', 'year' => 2002, 'author_id' => 5],
        ]);
    }
}
