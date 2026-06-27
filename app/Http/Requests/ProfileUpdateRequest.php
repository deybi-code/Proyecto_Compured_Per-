<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            // CORREGIDO: el campo del formulario es 'nombre_completo' y la columna única es 'correo'
            // El original validaba 'name' y 'email' que no coinciden con las columnas del modelo User.
            'nombre_completo' => ['required', 'string', 'max:255'],
            'correo' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                // CORREGIDO: ignore usa id_usuario (PK real), no ->id (que devolvería lo mismo pero es más explícito)
                Rule::unique('usuarios', 'correo')->ignore($this->user()->id_usuario, 'id_usuario'),
            ],
        ];
    }
}
