<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public    $timestamps = false;

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

    // CORREGIDO: Laravel usa 'email' y 'password' para autenticación por defecto.
    // Al tener columnas distintas, hay que sobrescribir getAuthIdentifierName y getAuthPassword.
    public function getEmailForPasswordReset() {
        return $this->correo;
    }

    // CORREGIDO: decirle a Laravel qué campo es el "email" para autenticación
    public function getAuthIdentifierName() {
        return 'id_usuario';
    }

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relación: un usuario tiene muchas boletas
    public function boletas() {
        return $this->hasMany(Boleta::class, 'id_usuario', 'id_usuario');
    }
}
