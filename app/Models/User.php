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

    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // CORREGIDO: Laravel necesita saber qué campo usar como "email" en autenticación
    public function getEmailForPasswordReset(): string
    {
        return $this->correo;
    }

    // CORREGIDO: Laravel usa este método para saber el campo del identificador único
    public function getAuthIdentifierName(): string
    {
        return 'id_usuario';
    }

    // CORREGIDO: decirle a Breeze/Auth qué campo es el "email" para login
    public function getAuthPassword(): string
    {
        return $this->password;
    }

    // Helpers de rol
    public function esAdmin(): bool
    {
        return $this->rol === 'administrador';
    }

    public function esVendedor(): bool
    {
        return in_array($this->rol, ['vendedor', 'administrador']);
    }

    // Relaciones
    public function boletas()
    {
        return $this->hasMany(Boleta::class, 'id_usuario', 'id_usuario');
    }
}
