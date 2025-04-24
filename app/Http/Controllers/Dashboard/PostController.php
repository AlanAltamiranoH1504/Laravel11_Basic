<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\requestPostCreate;
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
    public function store(RequestPostCreate $request)
    {
        try {
            $postSave = Post::create($request->all());
            return response()->json([
                "message" => "Post Creado Correctamente"
            ], 200);
        }catch (\Exception $e){
            return response()->json([
               "error" => $e->getMessage(),
                "file" => $e->getFile(),
                "line" => $e->getLine()
            ], $e->getCode());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        $postWithCategoria = Post::with("categoria")->find($post['id']);
        try {
            return response()->json([
                "post" => $postWithCategoria
            ], 200);
        }catch (\Exception $e){
            return response()->json([
               "error" => $e->getMessage(),
               "file" => $e->getFile(),
               "line" => $e->getLine()
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $postToUpdate = Post::find($request['id']);
            $postToUpdate->update($request->all());
            return response()->json([
                "message" => "Post Actualizado Correctamente"
            ], 200);
        }catch (\Exception $e){
            return response()->json([
                "error" => $e->getMessage(),
                "file" => $e->getFile(),
                "line" => $e->getLine()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        try {
            $id = $request['id'];
            $postFindById = Post::destroy($id);
            return response()->json([
                "message" => "Post eliminado correctamente!"
            ], 200);
        } catch (\Exception $e){
            return response()->json([
                "error" => $e->getMessage(),
                "file" => $e->getFile(),
                "line" => $e->getLine()
            ]);
        }
    }
}
