<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //Creacion de un post
//        $postCreado = Post::create([
//            "titulo" => "Post Prueba",
//            "slug" => "Post Prueba",
//            "descripcion" => "Post Prueba",
//            "contenido" => "Post Prueba",
//            "imagen" => "Post Prueba",
//            "publicado" => "no",
//            "categoria_id" => 1
//        ]);

        //Actualizacion de un post
//        $postFindById = Post::find(1);
//        $postFindById->update([
//            "titulo" => "Post Prueba actualizado",
//            "slug" => "Post Prueba actualizado",
//            "descripcion" => "Post Prueba actualizado",
//            "contenido" => "Post Prueba actualizado",
//            "imagen" => "Post Prueba actualizado",
//            "publicado" => "si",
//            "categoria_id" => 1
//        ]);

        //Eliminiacion de un post
        $postFindById = Post::find(2);
        if (!$postFindById){
            return json_encode([
                "code" => 500,
                "msg" => "Post no encontrado"
            ]);
        }

        $postFindById->delete();
        return json_encode([
            "status" => "200",
            "msg" => "Post creado eliminado correctamente"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $postCreado = Post::create([
            "titulo" => $request['titulo'],
            "slug" => $request['slug'],
            "descripcion" => $request['descripcion'],
            "contenido" => $request['contenido'],
            "imagen" => $request['imagen'],
            "publicado" => $request['publicado'],
            "categoria_id" => $request['categoria_id']
        ]);

        return json_encode([
            "status" => "200",
            "msg" => "Post creado de manera corrcta"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        //
    }
}
