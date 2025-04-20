<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("titulo", 150);
            $table->string("slug", 150);
            $table->text("descripcion")->nullable();
            $table->text("contenido")->nullable();
            $table->string("imagen", 500)->nullable();
            $table->enum("publicado", ["si", "no"])->default("no");
            $table->timestamps();

            //Relacion categorias (Un post tiene un categoria)
            $table->foreignId("categoria_id")->constrained()->onDelete("cascade")->onUpdate("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
