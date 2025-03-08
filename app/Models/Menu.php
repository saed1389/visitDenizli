<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $guarded = [];

    public static function getParentName($parent_id) {
        $parents = [
            1 => 'Hakkımızda',
            2 => 'Gezilecek Yerler',
            3 => 'Kültür ve Sanat',
            4 => 'Etkinlikler ve Haberler',
            5 => 'Turizm',
            6 => 'İş ve Ekonomi',
            7 => 'Fotoğraf ve Video Galeri',
            8 => 'Harita ve Ulaşım',
            9 => 'İletişim',
        ];

        return $parents[$parent_id] ?? 'Bilinmiyor'; // Default value if not found
    }
}
