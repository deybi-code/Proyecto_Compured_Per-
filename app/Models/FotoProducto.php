<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoProducto extends Model
{
    protected $table = 'fotos_productos'; // Asegúrate que coincida con tu BD
    protected $fillable = ['id_producto', 'ruta_foto'];

    public function producto() {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
