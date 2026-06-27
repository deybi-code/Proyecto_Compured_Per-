<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    protected $table = 'boletas';
    protected $primaryKey = 'id_boleta';
    public $timestamps = false;

    // Relación: Una boleta pertenece a un usuario
    public function usuario() {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }
}
