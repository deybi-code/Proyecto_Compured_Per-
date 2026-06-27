<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $timestamps = false; // Usas 'fecha_registro' manualmente

    protected $fillable = [
        'nombre_completo', 'correo', 'password', 'rol',
        'preferencia_tema', 'fecha_registro', 'remember_token'
    ];

    protected $hidden = ['password', 'remember_token'];
}
