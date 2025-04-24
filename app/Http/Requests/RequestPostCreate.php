<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestPostCreate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "titulo" => ['required', "string"],
            "slug" => ['required', "string"],
            "descripcion" => ["string"],
            "contenido" => ["string"],
            "imagen" => ["string"],
            "publicado" => ["string", "required"],
            "categora_id" => ["string", "required|exists: categorias,id"],
        ];
    }

    public function messages(): array{
        return [
            "titulo.required" => "El titulo es requerido",
            "titulo.string" => "El titulo debe ser una cadena de texto",
            "slug.required" => "El slug es requerido",
            "slug.string" => "El slug debe ser una cadena de texto",
            "descripcion.string" => "La descripcion debe ser una cadena de texto",
            "contenido.string" => "El contenido debe ser una cadena de texto ",
            "publicado.required" => "El campo publicado es requerido",
            "publicado.string" => "El campo publicado debe ser una cadena de texto",
            "categoria_id.required" => "El campo categoria es requerido",
        ];
    }
}
