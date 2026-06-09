<?php

use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\ProfileController;
use App\Models\Producto;
use Illuminate\Support\Facades\Route;

// ==========================================
// RUTAS PÚBLICAS (VISIBLES PARA TODOS)
// ==========================================
Route::get('/prueba-panel', function () {
    return "Si ves esto, el panel de control funciona perfectamente.";
});
// 1. Ruta del Home (Inicio de la tienda)
Route::get('/', function () {
    // Todos los productos para el inicio
    $productos = Producto::all();

    // Productos para la sección de "destacados" (tomamos 4 para rellenar la sección)
    $destacados = Producto::query()->where('mostrar_inicio', 1)->take(4)->get();

    // Enviamos ambas variables a la vista
    return view('index', compact('productos', 'destacados'));
})->name('inicio');

Route::get('/buscar', function (\Illuminate\Http\Request $request) {
    $termino = $request->query('q') ?? $request->query('buscar') ?? '';

    $productos = Producto::query()
        ->where('nombre', 'LIKE', "%{$termino}%")
        ->orWhere('marca', 'LIKE', "%{$termino}%")
        ->get();

    return view('buscar', compact('productos', 'termino'));
})->name('buscar');

Route::get('/carrito', function () {
    return view('carrito');
})->name('carrito');

// ==========================================
// RUTA DE CATEGORÍAS
// ==========================================
Route::get('/categoria/{id}', function ($id) {
    $productos = Producto::query()->where('id_categoria', $id)->get();

    // Asignamos el valor a la variable $categoria que espera tu vista
    $categoria = $id;

    return view('categoria', compact('productos', 'categoria'));
})->name('categoria');

// ==========================================
// RUTA DE DETALLE DE PRODUCTO
// ==========================================
Route::get('/producto/{id}', function ($id) {
    // 1. Traemos el producto principal
    $producto = Producto::findOrFail($id);

    $relacionados = Producto::query()
        ->where('id_categoria', $producto->id_categoria)
        ->where('id_producto', '!=', $id)
        ->take(4)
        ->get();

    // 3. Enviamos ambas variables a la vista
    return view('producto', compact('producto', 'relacionados'));
})->name('producto');
// ==========================================
// RUTAS PROTEGIDAS (USUARIOS NORMALES)
// ==========================================

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ==========================================
// RUTAS DE ADMINISTRADOR (SOLO ADMIN)
// ==========================================

Route::middleware(['auth', \App\Http\Middleware\EsAdmin::class])->group(function () {
    Route::get('/admin/productos', [AdminProductoController::class, 'index'])->name('admin.productos.index');
    Route::get('/admin/productos/create', [AdminProductoController::class, 'create'])->name('admin.productos.create');
    Route::post('/admin/productos', [AdminProductoController::class, 'store'])->name('admin.productos.store');
    Route::get('/admin/productos/{id}/edit', [AdminProductoController::class, 'edit'])->name('admin.productos.edit');
    Route::put('/admin/productos/{id}', [AdminProductoController::class, 'update'])->name('admin.productos.update');
    Route::delete('/admin/productos/{id}', [AdminProductoController::class, 'destroy'])->name('admin.productos.destroy');
});

require __DIR__.'/auth.php';
