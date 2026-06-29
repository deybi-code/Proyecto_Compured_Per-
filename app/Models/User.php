<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

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

    // SIN cast 'hashed' — Laravel no forzará verificación Bcrypt al leer
    protected function casts(): array
    {
        return [];
    }

    /**
     * Verifica la contraseña soportando Bcrypt Y texto plano / MD5.
     * Laravel llama a este método internamente en Auth::attempt().
     */
    public function getAuthPassword(): string
    {
        return $this->password;
    }

    /**
     * Override del check de contraseña para soportar múltiples formatos.
     * Si la contraseña en BD es Bcrypt → usa Hash::check normal.
     * Si no → compara texto plano o MD5 (compatibilidad con BD legada).
     */
    public function validateForPassportPasswordGrant(string $password): bool
    {
        return $this->checkPassword($password);
    }

    public function checkPassword(string $plain): bool
    {
        $stored = $this->password;

        // Bcrypt (empieza con $2y$ o $2a$)
        if (str_starts_with($stored, '$2y$') || str_starts_with($stored, '$2a$')) {
            return Hash::check($plain, $stored);
        }

        // MD5
        if (strlen($stored) === 32 && ctype_xdigit($stored)) {
            return md5($plain) === $stored;
        }

        // SHA1
        if (strlen($stored) === 40 && ctype_xdigit($stored)) {
            return sha1($plain) === $stored;
        }

        // Texto plano (último recurso)
        return $plain === $stored;
    }

    public function getEmailForPasswordReset(): string
    {
        return $this->correo;
    }

    public function getAuthIdentifierName(): string
    {
        return 'id_usuario';
    }

    // Helpers de rol
    public function esAdmin(): bool
    {
        return strtolower(trim($this->rol ?? '')) === 'admin';
    }

    public function esVendedor(): bool
    {
        $rol = strtolower(trim($this->rol ?? ''));
        return in_array($rol, ['admin', 'vendedor']);
    }

    // Relaciones
    public function boletas()
    {
        return $this->hasMany(Boleta::class, 'id_usuario', 'id_usuario');
    }
}
