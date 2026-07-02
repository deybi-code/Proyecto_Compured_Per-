<?php

use App\Http\Controllers\AdminAnuncioController;
use App\Http\Controllers\AdminProductoController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\BoletaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DistritoController;
use App\Http\Controllers\FotoProductoController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResenaController;
use App\Models\Boleta;
use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| 🌐 RUTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    $productos = Producto::with('fotos')
        ->where('mostrar_inicio', 1)
        ->orderBy('fecha_registro', 'desc')
        ->get();

    $categorias = Categoria::all();

    $anuncios = DB::table('anuncios')
        ->where('activo', 1)
        ->orderBy('id_anuncio', 'desc')
        ->get();

    return view('index', compact('productos', 'categorias', 'anuncios'));
})->name('home');

Route::get('/categoria/{slug?}', function (Request $request, $slug = null) {
    $categorias = Categoria::all();
    $productos = collect();
    $categoria = null;

    $orden = $request->input('orden', 'relevancia');
    $stock = $request->input('stock', '');
    $marca = $request->input('marca', '');

    if ($slug) {
        $cat = $categorias->first(fn ($c) => Str::slug($c->nombre_categoria) === $slug);
        if ($cat) {
            $categoria = $cat;
            $query = Producto::with('fotos')->where('id_categoria', $cat->id_categoria);

            // Filtro de stock
            if ($stock === 'con_stock') {
                $query->where('stock', '>', 0);
            } elseif ($stock === 'sin_stock') {
                $query->where('stock', '<=', 0);
            }

            // Filtro de marca
            if ($marca) {
                $query->where('marca', 'like', "%{$marca}%");
            }

            // Ordenamiento
            switch ($orden) {
                case 'precio_asc':
                    $query->orderBy('precio', 'asc');
                    break;
                case 'precio_desc':
                    $query->orderBy('precio', 'desc');
                    break;
                default:
                    $query->orderBy('fecha_registro', 'desc');
                    break;
            }

            $productos = $query->get();
        }
    }

    // Obtener marcas únicas de la categoría para el filtro
    $marcas = collect();
    if ($categoria) {
        $marcas = Producto::select('marca')
            ->where('id_categoria', $categoria->id_categoria)
            ->whereNotNull('marca')
            ->where('marca', '!=', '')
            ->distinct()
            ->orderBy('marca')
            ->pluck('marca');
    }

    return view('categoria', compact('categorias', 'productos', 'slug', 'categoria', 'orden', 'stock', 'marca', 'marcas'));
})->name('categoria');

Route::get('/producto/{id?}', function ($id = null) {
    $producto = $id ? Producto::with(['fotos', 'categoria', 'resenas.user'])->findOrFail($id) : null;
    $categorias = Categoria::all();

    // Productos relacionados: misma categoría, excluyendo el actual, máx 4
    $relacionados = collect();
    if ($producto && $producto->id_categoria) {
        $relacionados = Producto::with('fotos')
            ->where('id_categoria', $producto->id_categoria)
            ->where('id_producto', '!=', $producto->id_producto)
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->limit(4)
            ->get();
    }

    return view('producto', compact('producto', 'categorias', 'relacionados'));
})->name('producto');

Route::get('/nosotros', fn () => view('nosotros'))->name('nosotros');
Route::get('/terminos', fn () => view('terminos'))->name('terminos');

/*
|--------------------------------------------------------------------------
| 🔍 SEGUIMIENTO DE BOLETA
|--------------------------------------------------------------------------
*/

Route::get('/seguimiento', function (Request $request) {

    $boleta = null;
    $guia = null;

    if ($request->filled('boleta')) {
        $boleta = Boleta::find($request->input('boleta'));

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

Route::get('/buscar', function (Request $request) {
    $q = $request->input('q', '');
    $orden = $request->input('orden', 'relevancia'); // relevancia, precio_asc, precio_desc
    $stock = $request->input('stock', ''); // '', con_stock, sin_stock
    $marca = $request->input('marca', '');

    $query = Producto::with('fotos');

    if (strlen(trim($q)) >= 2) {
        $query->where(function ($query) use ($q) {
            $query->where('nombre', 'like', "%{$q}%")
                ->orWhere('marca', 'like', "%{$q}%")
                ->orWhere('detalles_tecnicos', 'like', "%{$q}%");
        });
    }

    // Filtro de stock
    if ($stock === 'con_stock') {
        $query->where('stock', '>', 0);
    } elseif ($stock === 'sin_stock') {
        $query->where('stock', '<=', 0);
    }

    // Filtro de marca
    if ($marca) {
        $query->where('marca', 'like', "%{$marca}%");
    }

    // Ordenamiento
    switch ($orden) {
        case 'precio_asc':
            $query->orderBy('precio', 'asc');
            break;
        case 'precio_desc':
            $query->orderBy('precio', 'desc');
            break;
        default:
            $query->orderBy('fecha_registro', 'desc');
            break;
    }

    $productos = $query->get();
    $categorias = Categoria::all();

    // Obtener marcas únicas para el filtro
    $marcas = Producto::select('marca')
        ->whereNotNull('marca')
        ->where('marca', '!=', '')
        ->distinct()
        ->orderBy('marca')
        ->pluck('marca');

    return view('buscar', compact('productos', 'categorias', 'q', 'orden', 'stock', 'marca', 'marcas'));
})->name('buscar');

// 🔍 API para búsqueda predictiva (autocomplete)
Route::get('/api/buscar', function (Request $request) {
    $q = trim($request->input('q', ''));

    if (strlen($q) < 2) {
        return response()->json([]);
    }

    $productos = Producto::with('fotos')
        ->where('stock', '>', 0)
        ->where(function ($query) use ($q) {
            $query->where('nombre', 'like', "%{$q}%")
                ->orWhere('marca', 'like', "%{$q}%")
                ->orWhere('detalles_tecnicos', 'like', "%{$q}%");
        })
        ->limit(10)
        ->get();

    return response()->json($productos->map(function ($producto) {
        $foto = $producto->fotos->first();

        return [
            'id' => $producto->id_producto,
            'nombre' => $producto->nombre,
            'marca' => $producto->marca,
            'precio' => $producto->precio,
            'imagen' => $foto ? $foto->ruta_foto : null,
            'url' => route('producto', $producto->id_producto),
        ];
    }));
})->name('api.buscar');

// 📍 API para obtener distritos de Trujillo
Route::get('/api/distritos', [DistritoController::class, 'index'])->name('api.distritos.index');
Route::get('/api/distritos/{id}', [DistritoController::class, 'show'])->name('api.distritos.show');

/*
|--------------------------------------------------------------------------
| 🔐 GOOGLE OAUTH  ← AÑADIDO
|--------------------------------------------------------------------------
*/

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])
    ->name('google.redirect');

Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback'])
    ->name('google.callback');

/*
|--------------------------------------------------------------------------
| 🛒 CARRITO
|--------------------------------------------------------------------------
*/

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
Route::delete('/carrito/{id}', [CarritoController::class, 'destroy'])->name('carrito.destroy');

Route::get('/checkout', fn () => view('pago'))->name('checkout');

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

    // 💬 Reseñas de productos
    Route::post('/resenas', [ResenaController::class, 'store'])->name('resenas.store');
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
            $totalProductos = Producto::count();
            $stockBajo = Producto::where('stock', '<=', 5)->count();
            $productosActivos = Producto::where('mostrar_inicio', 1)->count();
            $ventasDelDia = Boleta::whereDate('fecha_venta', today())->sum('total_pago');

            return view('admin.panel', compact('totalProductos', 'stockBajo', 'productosActivos', 'ventasDelDia'));
        })->name('panel');

        // 📦 PRODUCTOS
        // IMPORTANTE: las rutas específicas van ANTES de Route::resource(),
        // porque resource() registra DELETE /productos/{producto} y, si se
        // registra primero, "multiple" se interpreta como un id de producto.
        Route::post('/productos/importar', [AdminProductoController::class, 'importarExcel'])->name('productos.importar');
        Route::delete('/productos/multiple', [AdminProductoController::class, 'destroyMultiple'])->name('productos.destroyMultiple');
        Route::resource('productos', AdminProductoController::class);

        // 📢 ANUNCIOS
        Route::get('/anuncios', [AdminAnuncioController::class, 'index'])->name('anuncios.index');
        Route::post('/anuncios', [AdminAnuncioController::class, 'store'])->name('anuncios.store');
        Route::put('/anuncios', [AdminAnuncioController::class, 'update'])->name('anuncios.update');
        Route::delete('/anuncios/{id}', [AdminAnuncioController::class, 'destroy'])->name('anuncios.destroy');

        // 📸 FOTOS INDIVIDUALES DE PRODUCTOS
        Route::post('/productos/{id}/fotos', [FotoProductoController::class, 'store'])->name('fotos.store');
        Route::delete('/fotos/{id}', [FotoProductoController::class, 'destroy'])->name('fotos.destroy');
    });

require __DIR__.'/auth.php';
