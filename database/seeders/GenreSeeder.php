<?php

namespace Database\Seeders;

use App\Models\Genre;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GenreSeeder extends Seeder
{
    public function run(): void
    {
        Genre::insert([
            ['name' => 'Fiksi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Non-Fiksi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Biografi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Teknologi', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sejarah', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

