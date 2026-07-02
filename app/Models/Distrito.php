<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $fillable = ['nombre', 'latitud', 'longitud', 'distancia_km', 'costo_delivery', 'activo'];

    protected $casts = [
        'distancia_km' => 'decimal:2',
        'costo_delivery' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function scopeActivo($query)
    {
        return $query->where('activo', true);
    }
}
