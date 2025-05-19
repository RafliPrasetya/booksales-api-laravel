<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        Author::insert([
            ['name' => 'J.K. Rowling', 'email' => 'jk@example.com'],
            ['name' => 'George Orwell', 'email' => 'george@example.com'],
            ['name' => 'J.R.R. Tolkien', 'email' => 'tolkien@example.com'],
            ['name' => 'Agatha Christie', 'email' => 'agatha@example.com'],
            ['name' => 'Haruki Murakami', 'email' => 'murakami@example.com'],
        ]);
    }
}