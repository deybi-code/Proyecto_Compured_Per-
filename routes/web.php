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
| 🌐 RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => view('index'))->name('home');
Route::get('/categoria/{slug?}', fn() => view('categoria'))->name('categoria');
Route::get('/producto/{id?}', fn() => view('producto'))->name('producto');
Route::get('/nosotros', fn() => view('nosotros'))->name('nosotros');
Route::get('/terminos', fn() => view('terminos'))->name('terminos');

/*
|--------------------------------------------------------------------------
| 🔍 SEGUIMIENTO DE BOLETA
|--------------------------------------------------------------------------
*/

Route::get('/seguimiento', function (\Illuminate\Http\Request $request) {

    $boleta = null;
    $guia = null;

    if ($request->filled('boleta')) {

        $boleta = \App\Models\Boleta::find($request->input('boleta'));

        if ($boleta) {
            $guia = \Illuminate\Support\Facades\DB::table('guias_remision')
                ->where('id_boleta', $boleta->id_boleta)
                ->first();
        }
    }

    return view('seguimiento', compact('boleta', 'guia'));

})->name('seguimiento');

/*
|--------------------------------------------------------------------------
| 🛒 CARRITO
|--------------------------------------------------------------------------
*/

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
Route::delete('/carrito/{id}', [CarritoController::class, 'destroy'])->name('carrito.destroy');

Route::get('/checkout', fn() => view('pago'))->name('checkout');

/*
|--------------------------------------------------------------------------
| 🔐 USUARIO NORMAL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::post('/pagar', [PagoController::class, 'procesar'])->name('pago.procesar');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/dashboard/pedidos', [DashboardController::class, 'pedidos'])->name('pedidos');

    Route::get('/dashboard/perfil', [DashboardController::class, 'editProfile'])->name('perfil');
    Route::post('/dashboard/perfil', [DashboardController::class, 'updateProfile'])->name('perfil.update');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 🟡 VENDEDOR
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'es_vendedor'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
        Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');

        Route::get('/boletas/{id}', [BoletaController::class, 'show'])->name('boletas.show');
    });

/*
|--------------------------------------------------------------------------
| 🔴 ADMIN PRINCIPAL
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'es_admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // 📊 PANEL ADMIN
        Route::get('/panel', function () {
            return view('admin.panel');
        })->name('panel');

        // 📦 PRODUCTOS
        Route::resource('productos', AdminProductoController::class)
            ->names('productos');

        // 📢 ANUNCIOS
        Route::get('/anuncios', [AdminAnuncioController::class, 'index'])->name('anuncios.index');
        Route::post('/anuncios', [AdminAnuncioController::class, 'store'])->name('anuncios.store');
        Route::delete('/anuncios/{id}', [AdminAnuncioController::class, 'destroy'])->name('anuncios.destroy');
    });

require __DIR__.'/auth.php';
