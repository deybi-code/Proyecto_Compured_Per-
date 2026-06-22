<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;


    protected $table = 'productos';


    protected $primaryKey = 'id_producto';

    public $timestamps = false;

    protected $fillable = [
        'nombre',
        'precio',
        'stock',
        'marca',
        'detalles_tecnicos',
        'id_categoria',
        'fecha_registro',
        'mostrar_inicio',
        'imagen',  // FIX: imagen faltaba en fillable
    ];

    /**
     * Relación con la categoría (Opcional, pero muy útil)
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria', 'id_categoria');
    }
}
