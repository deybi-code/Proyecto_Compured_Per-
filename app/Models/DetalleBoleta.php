<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetalleBoleta extends Model
{
    protected $table      = 'detalle_boleta';
    // CORREGIDO: la columna real en la BD es 'id_detalle_boleta' (ver migración
    // create_detalle_boleta_table), no 'id_detalle'. Con el valor equivocado,
    // find()/update()/delete()/route-model-binding sobre este modelo fallaban
    // porque Eloquent buscaba una columna que no existe.
    protected $primaryKey = 'id_detalle_boleta';
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
