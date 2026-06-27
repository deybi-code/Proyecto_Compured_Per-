<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    // Forzamos a Eloquent a usar TU tabla, no la estándar
    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    public $timestamps = false; // No usamos created_at/updated_at por defecto

    protected $fillable = [
        'nombre', 'precio', 'stock', 'marca', 'detalles_tecnicos',
        'id_categoria', 'fecha_registro', 'mostrar_inicio'
    ];
}
