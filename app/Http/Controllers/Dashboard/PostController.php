<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Categoria;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(view: "dashboard.posts.index");
    }

    public function list()
    {
        $posts = Post::with("categoria")->get();
        return response()->json($posts,200);
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
