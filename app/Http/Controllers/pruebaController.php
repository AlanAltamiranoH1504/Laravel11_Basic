<?php

namespace App\Http\Controllers;

use App\Models\none;
use Illuminate\Http\Request;

class pruebaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "Desde el metodo index del controlador de prueba";
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(none $none)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(none $none)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, none $none)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(none $none)
    {
        //
    }
}
