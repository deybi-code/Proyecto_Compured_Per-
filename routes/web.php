<?php

use Illuminate\Support\Facades\Route;

// Importación de todos los controladores necesarios
use App\Http\Controllers\{
    DashboardController,
    CarritoController,
    PagoController,
    AdminProductoController,
    VentasController,
    AdminAnuncioController,
    BoletaController
};

/*
|--------------------------------------------------------------------------
| 1. RUTAS PÚBLICAS (Catálogo y Navegación)
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return view('index'); })->name('home');
Route::get('/categoria/{slug?}', function () { return view('categoria'); })->name('categoria');
Route::get('/producto/{id?}', function () { return view('producto'); })->name('producto');

/*
|--------------------------------------------------------------------------
| 2. CARRITO Y CHECKOUT
|--------------------------------------------------------------------------
*/
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');

Route::get('/checkout', function () { return view('pago'); })->name('checkout');
Route::post('/pagar', [PagoController::class, 'procesar'])->name('pago.procesar');

/*
|--------------------------------------------------------------------------
| 3. RUTAS PROTEGIDAS (Requieren Login)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard y Perfil
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/pedidos', [DashboardController::class, 'pedidos'])->name('pedidos');
    Route::get('/dashboard/depositos', [DashboardController::class, 'depositos'])->name('depositos');
    Route::get('/dashboard/tickets', [DashboardController::class, 'tickets'])->name('tickets');
    Route::get('/dashboard/perfil', [DashboardController::class, 'editProfile'])->name('perfil');
    Route::post('/dashboard/perfil', [DashboardController::class, 'updateProfile'])->name('perfil.update');

    /*
    |----------------------------------------------------------------------
    | 4. PANEL ADMINISTRATIVO Y VENTAS (Gestión interna)
    |----------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {

        // Gestión de Productos (CRUD completo)
        Route::get('/productos', [AdminProductoController::class, 'index'])->name('admin.productos');
        Route::get('/productos/create', [AdminProductoController::class, 'create'])->name('admin.productos.create');
        Route::post('/productos', [AdminProductoController::class, 'store'])->name('admin.productos.store');

        // Punto de Venta (POS)
        Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
        Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');

        // Gestión de Anuncios (Banner)
        Route::get('/anuncios', [AdminAnuncioController::class, 'index'])->name('anuncios.index');
        Route::post('/anuncios', [AdminAnuncioController::class, 'store'])->name('anuncios.store');
        Route::delete('/anuncios/{id}', [AdminAnuncioController::class, 'destroy'])->name('anuncios.destroy');

        // Impresión de Boletas
        Route::get('/boletas/{id}', [BoletaController::class, 'show'])->name('boletas.show');
    });
});

/*
|--------------------------------------------------------------------------
| 5. RUTAS DE AUTENTICACIÓN (Breeze/Jetstream)
|--------------------------------------------------------------------------
*/
// Este archivo es vital para que login/register funcionen
require __DIR__.'/auth.php';
