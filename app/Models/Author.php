<?php

namespace App\Models;

class Author
{
    public static function all()
    {
        return [
            ['name' => 'Rafli Prasetya', 'email' => 'rafli@example.com'],
            ['name' => 'Dina Maharani', 'email' => 'dina@example.com'],
            ['name' => 'Ali Murtadho', 'email' => 'ali@example.com'],
            ['name' => 'Zahra Lestari', 'email' => 'zahra@example.com'],
            ['name' => 'Fajar Nugroho', 'email' => 'fajar@example.com'],
        ];
    }
}
