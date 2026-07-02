<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';

    protected $primaryKey = 'id_producto';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'precio',
        'precio_descuento',
        'porcentaje_descuento',
        'stock',
        'marca',
        'detalles_tecnicos',
        'id_categoria',
        'imagen',
        'fecha_registro',
        'mostrar_inicio',
    ];

    // Relaciones
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }

    public function detallesBoleta()
    {
        return $this->hasMany(DetalleBoleta::class, 'id_producto', 'id_producto');
    }

    /**
     * Relación corregida: Apunta al modelo FotoProducto
     * Asegúrate que en la tabla 'fotos_productos' exista la columna 'id_producto'
     */
    public function fotos()
    {
        return $this->hasMany(FotoProducto::class, 'id_producto', 'id_producto');
    }

    public function resenas()
    {
        return $this->hasMany(Resena::class, 'producto_id', 'id_producto')->where('aprobado', true);
    }
}
