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
