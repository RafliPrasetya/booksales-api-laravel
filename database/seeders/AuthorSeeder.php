<?php

namespace Database\Seeders;
use Illuminate\Support\Carbon;
use Illuminate\Database\Seeder;
use App\Models\Author;

class AuthorSeeder extends Seeder
{
  public function run(): void
  {
    Author::insert([
      ['name' => 'J.K. Rowling', 'email' => 'jk@email.com', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'George Orwell', 'email' => 'george@email.com', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'J.R.R. Tolkien', 'email' => 'tolkien@email.com', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Agatha Christie', 'email' => 'agatha@email.com', 'created_at' => now(), 'updated_at' => now()],
      ['name' => 'Haruki Murakami', 'email' => 'murakami@email.com', 'created_at' => now(), 'updated_at' => now()],
    ]);
  }
}
