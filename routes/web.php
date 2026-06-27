<?php

use Illuminate\Support\Facades\Route;
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
| 1. RUTAS PÚBLICAS
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
Route::post('/pagar', [PagoController::class, 'procesar'])->name('pago.procesar');

/*
|--------------------------------------------------------------------------
| 3. RUTAS PROTEGIDAS (Requieren Autenticación)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard y Perfil
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/pedidos', [DashboardController::class, 'pedidos'])->name('pedidos');
    Route::get('/dashboard/perfil', [DashboardController::class, 'editProfile'])->name('perfil');
    Route::post('/dashboard/perfil', [DashboardController::class, 'updateProfile'])->name('perfil.update');

    /*
    |----------------------------------------------------------------------
    | 4. PANEL ADMINISTRATIVO Y VENTAS
    |----------------------------------------------------------------------
    */
    Route::prefix('admin')->group(function () {

        // GESTIÓN DE PRODUCTOS (CRUD completo resuelto)
        // Esto genera automáticamente: index, create, store, edit, update, destroy
        Route::resource('productos', AdminProductoController::class)->names('admin.productos');

        // PUNTO DE VENTA (POS)
        Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
        Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');

        // GESTIÓN DE ANUNCIOS
        Route::get('/anuncios', [AdminAnuncioController::class, 'index'])->name('anuncios.index');
        Route::post('/anuncios', [AdminAnuncioController::class, 'store'])->name('anuncios.store');
        Route::delete('/anuncios/{id}', [AdminAnuncioController::class, 'destroy'])->name('anuncios.destroy');

        // BOLETAS (Impresión)
        Route::get('/boletas/{id}', [BoletaController::class, 'show'])->name('boletas.show');
    });
});

require __DIR__.'/auth.php';
