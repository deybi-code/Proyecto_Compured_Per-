<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

// Grupo de rutas protegidas (Solo usuarios logueados pueden entrar)
Route::middleware('auth')->group(function () {

    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pestañas del Panel de Usuario (basadas en tu diagrama)
    Route::get('/dashboard/pedidos', [DashboardController::class, 'pedidos'])->name('pedidos');
    Route::get('/dashboard/depositos', [DashboardController::class, 'depositos'])->name('depositos');
    Route::get('/dashboard/tickets', [DashboardController::class, 'tickets'])->name('tickets');
    Route::get('/dashboard/perfil', [DashboardController::class, 'editProfile'])->name('perfil');
    Route::post('/dashboard/perfil', [DashboardController::class, 'updateProfile'])->name('perfil.update');
});
