<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // 1. Definir el nombre de la tabla personalizada
    protected $table = 'usuarios';

    // 2. Definir tu llave primaria personalizada
    protected $primaryKey = 'id_usuario';

    // 3. Desactivar las columnas automáticas de tiempo de Laravel (created_at y updated_at)
    public $timestamps = false;

    /**
     * Los atributos que se pueden asignar masivamente.
     * Ajustados a las columnas reales de tu tabla 'usuarios'.
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
     * Atributos que deben ser casteados (mutados).
     */
    protected function casts(): array
    {
        return [
            'fecha_registro' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
        * Sobrescribir el método getAuthPassword para que Laravel sepa qué campo usar para la autenticación.
        */
    public function getAuthPassword()
    {
        return $this->password;
    }
    /**
     * Anular el manejo del remember token ya que no existe en la base de datos.
     */
    public function getRememberTokenName()
    {
        return ''; // Retorna vacío para que Laravel no busque ninguna columna
    }
}
