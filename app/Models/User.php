<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false; // Como usamos 'fecha_registro' manual, desactivamos timestamps automáticos

    protected $fillable = [
        'nombre_completo',
        'correo',
        'password',
        'rol',
        'preferencia_tema',
        'fecha_registro',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
