<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    protected $primaryKey = 'id_usuario';

    /**
     * La tabla 'usuarios' no tiene columnas created_at / updated_at,
     * solo tiene 'fecha_registro'. Por eso desactivamos los timestamps
     * automáticos de Eloquent (si no, el INSERT falla con
     * "Unknown column 'updated_at' in 'field list'").
     */
    public $timestamps = false;

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

    public function getEmailForPasswordReset(): string
    {
        return (string) ($this->attributes['correo'] ?? '');
    }

    /**
     * @return array<int, string>
     */
    public static function rolesVendedor(): array
    {
        return ['admin', 'vendedor', 'ventas'];
    }

    public function tieneRolVendedor(): bool
    {
        return in_array(strtolower(trim($this->rol ?? '')), self::rolesVendedor(), true);
    }
}
