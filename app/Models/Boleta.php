<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    protected $table      = 'boletas';
    protected $primaryKey = 'id_boleta';
    public    $timestamps = false;

    protected $fillable = [
        'id_usuario', 'fecha_venta', 'total_pago',
        'metodo_pago', 'canal_venta', 'estado_pedido',
        'tipo_comprobante', 'serie_comprobante', 'ruc_empresa',
    ];

    // Relación: una boleta pertenece a un usuario
    public function usuario() {
        return $this->belongsTo(User::class, 'id_usuario', 'id_usuario');
    }

    // AÑADIDO: relación con los detalles de la boleta
    public function detalles() {
        return $this->hasMany(DetalleBoleta::class, 'id_boleta', 'id_boleta');
    }
}
