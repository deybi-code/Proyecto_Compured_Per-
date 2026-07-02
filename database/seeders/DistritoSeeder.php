<?php

namespace Database\Seeders;

use App\Models\Distrito;
use Illuminate\Database\Seeder;

class DistritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $distritos = [
            [
                'nombre' => 'Trujillo (Centro Histórico)',
                'latitud' => -8.1116,
                'longitud' => -79.0298,
                'distancia_km' => 0,
                'costo_delivery' => 0,
            ],
            [
                'nombre' => 'Victor Larco Herrera',
                'latitud' => -8.1289,
                'longitud' => -79.0467,
                'distancia_km' => 3.5,
                'costo_delivery' => 8.75,
            ],
            [
                'nombre' => 'Florencia de Mora',
                'latitud' => -8.0978,
                'longitud' => -79.0589,
                'distancia_km' => 4.2,
                'costo_delivery' => 10.50,
            ],
            [
                'nombre' => 'La Esperanza',
                'latitud' => -8.0723,
                'longitud' => -79.0234,
                'distancia_km' => 6.0,
                'costo_delivery' => 15.00,
            ],
            [
                'nombre' => 'El Porvenir',
                'latitud' => -8.0656,
                'longitud' => -79.0123,
                'distancia_km' => 8.5,
                'costo_delivery' => 21.25,
            ],
            [
                'nombre' => 'Huanchaco',
                'latitud' => -8.0878,
                'longitud' => -79.1289,
                'distancia_km' => 12.0,
                'costo_delivery' => 30.00,
            ],
            [
                'nombre' => 'Moche',
                'latitud' => -8.1756,
                'longitud' => -79.0987,
                'distancia_km' => 15.0,
                'costo_delivery' => 37.50,
            ],
            [
                'nombre' => 'Salaverry',
                'latitud' => -8.1234,
                'longitud' => -79.2456,
                'distancia_km' => 14.0,
                'costo_delivery' => 35.00,
            ],
            [
                'nombre' => 'Laredo',
                'latitud' => -8.0234,
                'longitud' => -79.0567,
                'distancia_km' => 15.5,
                'costo_delivery' => 38.75,
            ],
            [
                'nombre' => 'Simbal',
                'latitud' => -8.0456,
                'longitud' => -79.1123,
                'distancia_km' => 20.0,
                'costo_delivery' => 50.00,
            ],
            [
                'nombre' => 'Casa Grande',
                'latitud' => -7.9876,
                'longitud' => -79.0890,
                'distancia_km' => 18.0,
                'costo_delivery' => 45.00,
            ],
        ];

        foreach ($distritos as $distrito) {
            Distrito::updateOrCreate(
                ['nombre' => $distrito['nombre']],
                $distrito
            );
        }
    }
}
