<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            "id" => 1,
            "nombre" => "Publicacion Facebook",
            "slug" => "publicacion-facebook",
        ]);
        Categoria::create([
            "id" => 2,
            "nombre" => "Publicacion Twitter",
            "slug" => "publicacion-twitter",
        ]);
        Categoria::create([
            "id" => 3,
            "nombre" => "Publicacion Instagram",
            "slug" => "publicacion-instagram",
        ]);
        Categoria::create([
            "id" => 4,
            "nombre" => "Publicacion TikTok",
            "slug" => "publicacion-tiktok",
        ]);
    }
}
