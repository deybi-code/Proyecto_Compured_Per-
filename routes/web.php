<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    DashboardController,
    CarritoController,
    PagoController,
    AdminProductoController,
    VentasController,
    AdminAnuncioController,
    BoletaController,
    ProfileController
};

/*
|--------------------------------------------------------------------------
| 1. RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/
Route::get('/', function () { return view('index'); })->name('home');
Route::get('/categoria/{slug?}', function () { return view('categoria'); })->name('categoria');
Route::get('/producto/{id?}', function () { return view('producto'); })->name('producto');
Route::get('/nosotros', function () { return view('nosotros'); })->name('nosotros');
Route::get('/terminos', function () { return view('terminos'); })->name('terminos');

/*
|--------------------------------------------------------------------------
| 2. CARRITO Y CHECKOUT
|--------------------------------------------------------------------------
*/
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
Route::delete('/carrito/{id}', [CarritoController::class, 'destroy'])->name('carrito.destroy');
Route::get('/checkout', function () { return view('pago'); })->name('checkout');
Route::post('/pagar', [PagoController::class, 'procesar'])->name('pago.procesar');

/*
|--------------------------------------------------------------------------
| 3. RUTAS PROTEGIDAS (Requieren Autenticación)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/pedidos', [DashboardController::class, 'pedidos'])->name('pedidos');
    Route::get('/dashboard/perfil', [DashboardController::class, 'editProfile'])->name('perfil');
    Route::post('/dashboard/perfil', [DashboardController::class, 'updateProfile'])->name('perfil.update');

    // CORREGIDO: rutas profile.* que estaban ausentes y son usadas en navigation y vistas de perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |----------------------------------------------------------------------
    | 4. PANEL ADMINISTRATIVO (protegido con es_admin)
    |----------------------------------------------------------------------
    */
    // CORREGIDO: las rutas admin ahora requieren el middleware 'es_admin' además de 'auth'
    // Antes cualquier usuario autenticado podía acceder al panel admin.
    Route::middleware(['es_admin'])->prefix('admin')->group(function () {

        // GESTIÓN DE PRODUCTOS (CRUD completo)
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
