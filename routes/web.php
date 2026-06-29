<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Categoria;
use App\Models\Producto;
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
Route::get('/', function () {
    // FIX: antes este closure devolvía la vista sin ninguna variable,
    // por eso el inicio siempre mostraba el estado vacío/skeleton.
    $categorias = Categoria::orderBy('nombre_categoria')->get();
    $productos  = Producto::orderByDesc('id_producto')->take(8)->get();
    $anuncios   = DB::table('anuncios')->where('activo', 1)->get();

    return view('index', compact('categorias', 'productos', 'anuncios'));
})->name('home');

Route::get('/categoria/{slug?}', function ($slug = null) {
    // FIX: antes este closure ignoraba el {slug} por completo,
    // por eso siempre mostraba "Categoría" y "0 productos disponibles".
    $categoria = null;
    $productos = collect();

    if ($slug) {
        $categoria = Categoria::all()->first(
            fn ($cat) => Str::slug($cat->nombre_categoria) === $slug
        );
    }

    if ($categoria) {
        $productos = Producto::where('id_categoria', $categoria->id_categoria)->get();
    }

    return view('categoria', compact('categoria', 'productos'));
})->name('categoria');

Route::get('/producto/{id?}', function ($id = null) {
    // FIX: antes este closure ignoraba el {id} y nunca cargaba el producto.
    $producto = $id ? Producto::with(['categoria', 'fotos'])->find($id) : null;

    return view('producto', compact('producto'));
})->name('producto');

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

// CORREGIDO: el checkout y pago requieren login (no puede pagar sin estar autenticado)
Route::middleware(['auth'])->group(function () {

    Route::post('/pagar', [PagoController::class, 'procesar'])->name('pago.procesar');

    /*
    |--------------------------------------------------------------------------
    | 3. DASHBOARD Y PERFIL (cualquier usuario autenticado)
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/pedidos', [DashboardController::class, 'pedidos'])->name('pedidos');
    Route::get('/dashboard/perfil', [DashboardController::class, 'editProfile'])->name('perfil');
    Route::post('/dashboard/perfil', [DashboardController::class, 'updateProfile'])->name('perfil.update');

    // Rutas de perfil de Breeze
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    /*
    |--------------------------------------------------------------------------
    | 4. PANEL DE VENTAS (vendedor y administrador)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['es_vendedor'])->prefix('admin')->group(function () {
        Route::get('/ventas', [VentasController::class, 'index'])->name('ventas.index');
        Route::post('/ventas', [VentasController::class, 'store'])->name('ventas.store');
        Route::get('/boletas/{id}', [BoletaController::class, 'show'])->name('boletas.show');
    });

    /*
    |--------------------------------------------------------------------------
    | 5. PANEL ADMINISTRATIVO (solo administrador)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['es_admin'])->prefix('admin')->group(function () {
        // CRUD de productos
        Route::resource('productos', AdminProductoController::class)->names('admin.productos');

        // Gestión de anuncios
        Route::get('/anuncios', [AdminAnuncioController::class, 'index'])->name('anuncios.index');
        Route::post('/anuncios', [AdminAnuncioController::class, 'store'])->name('anuncios.store');
        Route::delete('/anuncios/{id}', [AdminAnuncioController::class, 'destroy'])->name('anuncios.destroy');
    });
});

require __DIR__.'/auth.php';
