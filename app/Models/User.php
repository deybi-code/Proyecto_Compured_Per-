<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $fillable = [
        'nombre_completo',
        'correo',
        'password',
        'rol',
        'preferencia_tema',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * AÑADIDO: algunas vistas heredadas de Breeze (layouts/navigation.blade.php)
     * usan Auth::user()->name y ->email, pero tus columnas reales son
     * 'nombre_completo' y 'correo'. Estos accessors evitan que esas vistas
     * truenen con "Property [name] does not exist".
     */
    public function getNameAttribute()
    {
        return $this->attributes['nombre_completo'] ?? null;
    }

    public function getEmailAttribute()
    {
        return $this->attributes['correo'] ?? null;
    }
}
