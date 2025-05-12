<?php

namespace App\Models;

class Genre
{
    public static function all()
    {
        return [
            ['name' => 'Fiksi'],
            ['name' => 'Non-Fiksi'],
            ['name' => 'Biografi'],
            ['name' => 'Teknologi'],
            ['name' => 'Sejarah'],
        ];
    }
}
