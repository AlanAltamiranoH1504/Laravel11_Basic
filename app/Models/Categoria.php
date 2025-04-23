<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $fillable = ["nombre", "slug"];

    //Relacion - Una categoria puede tener varios post
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
