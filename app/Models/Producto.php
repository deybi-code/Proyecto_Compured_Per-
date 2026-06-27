<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false;

    protected $fillable = [
        'nombre', 'precio', 'stock', 'marca',
        'detalles_tecnicos', 'id_categoria', 'mostrar_inicio'
    ];

    // Relación con Categoría
    public function categoria() {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
}
