<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTipoDocumento extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nombre' => 'required|min:3',
            'descripcion' => 'required|regex:/^[ña-zA-Z0-9 ]{5,}$/',
        ];
    }
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres',
            'descripcion.required' => 'La descripcion es obligatoria',
            'descripcion.regex' => 'La descripcion debe tener al menos
                                    5 caracteres y ser minusculas',
        ];
    }
}
