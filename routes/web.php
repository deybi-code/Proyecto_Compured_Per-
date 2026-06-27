<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PagoController;

// Rutas Públicas
Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/categoria/{slug?}', function () {
    return view('categoria');
})->name('categoria');

Route::get('/producto/{id?}', function () {
    return view('producto');
})->name('producto');

// Carrito y Pagos
Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');

Route::get('/checkout', function () {
    return view('pago');
})->name('checkout');
Route::post('/pagar', [PagoController::class, 'procesar'])->name('pago.procesar');

// Rutas Privadas (Panel de Usuario)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/pedidos', [DashboardController::class, 'pedidos'])->name('pedidos');
    Route::get('/dashboard/depositos', [DashboardController::class, 'depositos'])->name('depositos');
    Route::get('/dashboard/tickets', [DashboardController::class, 'tickets'])->name('tickets');
    Route::get('/dashboard/perfil', [DashboardController::class, 'editProfile'])->name('perfil');
    Route::post('/dashboard/perfil', [DashboardController::class, 'updateProfile'])->name('perfil.update');
});

// Cargar rutas de autenticación (Breeze)
require __DIR__.'/auth.php';
