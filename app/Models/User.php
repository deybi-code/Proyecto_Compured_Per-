<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 1. Tabla personalizada
    protected $table = 'usuarios';

    // 2. Llave primaria personalizada
    protected $primaryKey = 'id_usuario';

    // 3. Sin timestamps automáticos de Laravel
    public $timestamps = false;

    /**
     * FIX CRÍTICO #3: Declarar el identificador de autenticación.
     * Sin esto, Laravel busca 'id' en vez de 'id_usuario' y el login falla.
     */
    public function getAuthIdentifierName(): string
    {
        return 'id_usuario';
    }

    /**
     * Los atributos que se pueden asignar masivamente.
     */
    protected $fillable = [
    'nombre_completo',
    'correo',
    'password',
    'rol',
    'preferencia_tema',
    'fecha_registro',
];

    /**
     * Los atributos que deben ocultarse para la serialización.
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Atributos que deben ser casteados.
     */
    protected function casts(): array
    {
        return [
            'fecha_registro' => 'datetime',
            'password'       => 'hashed',
            'rol'            => 'string',
        ];
    }

    /**
     * FIX: Laravel debe saber qué campo usar como contraseña.
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * FIX: Sin columna remember_token en la tabla 'usuarios'.
     */
    public function getRememberTokenName()
    {
        return '';
    }
}
