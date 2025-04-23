<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        "titulo",
        "slug",
        "descripcion",
        "contenido",
        "imagen",
        "publicado",
        "categoria_id"
    ];

    //Relacion - Un Post pertenece a una categoria
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, "categoria_id");
    }
}
