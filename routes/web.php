<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\{
    DashboardController,
    FotoProductoController,
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

Route::get('/', function () {
    $productos  = \App\Models\Producto::with('fotos')
                    ->where('mostrar_inicio', 1)
                    ->orderBy('fecha_registro', 'desc')
                    ->get();

    $categorias = \App\Models\Categoria::all();

    $anuncios   = DB::table('anuncios')
                    ->where('activo', 1)
                    ->orderBy('id_anuncio', 'desc')
                    ->get();

    return view('index', compact('productos', 'categorias', 'anuncios'));
})->name('home');

Route::get('/categoria/{slug?}', function ($slug = null) {
    $categorias = \App\Models\Categoria::all();
    $productos  = collect();

    if ($slug) {
        $cat = $categorias->first(fn($c) =>
            \Illuminate\Support\Str::slug($c->nombre_categoria) === $slug
        );
        if ($cat) {
            $productos = \App\Models\Producto::with('fotos')
                ->where('id_categoria', $cat->id_categoria)
                ->get();
        }
    }

    return view('categoria', compact('categorias', 'productos', 'slug'));
})->name('categoria');

Route::get('/producto/{id?}', function ($id = null) {
    $producto   = $id ? \App\Models\Producto::with(['fotos', 'categoria'])->findOrFail($id) : null;
    $categorias = \App\Models\Categoria::all();

    // Productos relacionados: misma categoría, excluyendo el actual, máx 4
    $relacionados = collect();
    if ($producto && $producto->id_categoria) {
        $relacionados = \App\Models\Producto::with('fotos')
            ->where('id_categoria', $producto->id_categoria)
            ->where('id_producto', '!=', $producto->id_producto)
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    return view('producto', compact('producto', 'categorias', 'relacionados'));
})->name('producto');

Route::get('/nosotros', fn() => view('nosotros'))->name('nosotros');
Route::get('/terminos', fn()  => view('terminos'))->name('terminos');

/*
|--------------------------------------------------------------------------
| 🔍 SEGUIMIENTO DE BOLETA
|--------------------------------------------------------------------------
*/

Route::get('/seguimiento', function (\Illuminate\Http\Request $request) {

    $boleta = null;
    $guia   = null;

    if ($request->filled('boleta')) {
        $boleta = \App\Models\Boleta::find($request->input('boleta'));

        if ($boleta) {
            $guia = DB::table('guias_remision')
                ->where('id_boleta', $boleta->id_boleta)
                ->first();
        }
    }

    return view('seguimiento', compact('boleta', 'guia'));

})->name('seguimiento');

/*
|--------------------------------------------------------------------------
| 🔍 BUSCADOR PÚBLICO
|--------------------------------------------------------------------------
*/

Route::get('/buscar', function (\Illuminate\Http\Request $request) {
    $q         = $request->input('q', '');
    $productos = collect();

    if (strlen(trim($q)) >= 2) {
        $productos = \App\Models\Producto::with('fotos')
            ->where('nombre', 'like', "%{$q}%")
            ->orWhere('marca', 'like', "%{$q}%")
            ->orWhere('detalles_tecnicos', 'like', "%{$q}%")
            ->get();
    }

    $categorias = \App\Models\Categoria::all();
    return view('buscar', compact('productos', 'categorias', 'q'));
})->name('buscar');

/*
|--------------------------------------------------------------------------
| 🔐 GOOGLE OAUTH  ← AÑADIDO
|--------------------------------------------------------------------------
*/

Route::get('auth/google', [\App\Http\Controllers\Auth\GoogleController::class, 'redirectToGoogle'])
    ->name('google.redirect');

Route::get('auth/google/callback', [\App\Http\Controllers\Auth\GoogleController::class, 'handleGoogleCallback'])
    ->name('google.callback');

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

    // 💳 Pasarela de pago (solo se usa cuando el método elegido es "tarjeta")
    Route::get('/pago/pasarela', [PagoController::class, 'mostrarPasarela'])->name('pago.pasarela');
    Route::post('/pago/pasarela', [PagoController::class, 'confirmarTarjeta'])->name('pago.pasarela.confirmar');
    Route::post('/pago/pasarela/cancelar', [PagoController::class, 'cancelarPasarela'])->name('pago.pasarela.cancelar');

    // 🧾 Boleta electrónica del cliente (la boleta debe ser suya)
    Route::get('/mis-boletas/{id}', [BoletaController::class, 'showCliente'])->name('boletas.mia');

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
            $totalProductos   = \App\Models\Producto::count();
            $stockBajo        = \App\Models\Producto::where('stock', '<=', 5)->count();
            $productosActivos = \App\Models\Producto::where('mostrar_inicio', 1)->count();
            return view('admin.panel', compact('totalProductos', 'stockBajo', 'productosActivos'));
        })->name('panel');

        // 📦 PRODUCTOS
        Route::resource('productos', AdminProductoController::class);

        // 📢 ANUNCIOS
        Route::get('/anuncios', [AdminAnuncioController::class, 'index'])->name('anuncios.index');
        Route::post('/anuncios', [AdminAnuncioController::class, 'store'])->name('anuncios.store');
        Route::delete('/anuncios/{id}', [AdminAnuncioController::class, 'destroy'])->name('anuncios.destroy');

        // 📸 FOTOS INDIVIDUALES DE PRODUCTOS
        Route::post('/productos/{id}/fotos', [FotoProductoController::class, 'store'])->name('fotos.store');
        Route::delete('/fotos/{id}', [FotoProductoController::class, 'destroy'])->name('fotos.destroy');
    });

require __DIR__.'/auth.php';
