<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleBoleta extends Model
{
    protected $table      = 'detalle_boleta';
    protected $primaryKey = 'id_detalle';
    public    $timestamps = false;

    protected $fillable = [
        'id_boleta',
        'id_producto',
        'cantidad',
        'precio_unitario',
    ];

    // Relaciones
    public function boleta()
    {
        return $this->belongsTo(Boleta::class, 'id_boleta', 'id_boleta');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id_producto');
    }
}
