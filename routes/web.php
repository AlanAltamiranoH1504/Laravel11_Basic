<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Rutas de prueba
Route::get("/mensaje-bienvenida", function (){
    return "Mensaje de bienvenida de Laravel";
});
//Rutas con parametros obigatios y opcionales
Route::get("/param/{id?}", function ($id = "Parametro no enviado"){
    return "Vista con un parametro opcional. Valor del parametro: ".$id;
});
Route::get("/param/obligatorio/{id}", function ($id){
   return "Vista con un parametro obligatorio. Valor del parametro: ".$id;
});

//Ruta que retorna vista
Route::get("/vista/{num}", function ($num = "Sin parametro"){
    return view("test.prueba");
});
Route::get("/vista/{num}", function ($num){
    return view("test.prueba", [
        'num' => $num
    ]);
});

//Rutas con vistas asociadas
Route::get("/vistas/vista1", function (){
    return view("test.vista1");
})->name("vista1");
Route::get("/vistas/vista2", function (){
    return redirect()->route("vista1");
})->name("vista2.blade.php");
Route::get("/contact1", function () {
    $paises = ["Mexico", "Argentina", "Alemania", "Canada"];
    return view("/test/contact", [
        "paises" => $paises
    ]);
});
//Rutas que usan el layout
Route::get("/home", function (){
    return view("home");
});

//Rutas para el controlador prueba de tipo recurso
Route::resource("pruebaController", \App\Http\Controllers\pruebaController::class);
