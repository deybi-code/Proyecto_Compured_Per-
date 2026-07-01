<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Auth;
use App\Auth\FlexibleUserProvider;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Forzar HTTPS en producción
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // CORREGIDO: se quitó la limpieza de caché (view/cache/config) que
        // corría en boot(). boot() se ejecuta en CADA petición HTTP, así que
        // esto anulaba el caché de vistas/config en cada carga de página y
        // agregaba lecturas/escrituras a disco de forma constante. La
        // limpieza de caché ya se hace correctamente una sola vez por deploy
        // en docker/entrypoint.sh (config:clear, route:clear, view:clear).

        // Registrar proveedor de autenticación flexible
        // Soporta contraseñas en Bcrypt, MD5, SHA1 y texto plano
        Auth::provider('flexible-eloquent', function ($app, array $config) {
            return new FlexibleUserProvider(
                $app['hash'],
                $config['model'] ?? User::class
            );
        });
    }
}
