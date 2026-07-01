<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoProducto extends Model
{
    protected $table      = 'fotos_productos';
    protected $primaryKey = 'id_foto';   // ← clave correcta para findOrFail y destroy
    public $timestamps    = false;

    protected $fillable = ['id_producto', 'ruta_foto', 'es_principal'];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
