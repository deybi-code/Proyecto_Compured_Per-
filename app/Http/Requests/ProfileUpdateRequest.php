<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_completo' => ['required', 'string', 'max:255'],
            'correo' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('usuarios', 'correo')->ignore(
                    Auth::user()->id_usuario,
                    'id_usuario'
                ),
            ],
        ];
    }
}
