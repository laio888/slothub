<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\AdminController;

// ════════════════════════════════════════
// PÁGINAS PÚBLICAS
// ════════════════════════════════════════

Route::get('/', function () {
    return view('inicio');
})->name('inicio');

Route::get('/servicios', function () {
    $servicios = \App\Models\Servicio::where('estado_servicio', 'activo')
        ->orderBy('categoria')
        ->get()
        ->groupBy('categoria');
    return view('servicios', compact('servicios'));
})->name('servicios');

// ════════════════════════════════════════
// AUTENTICACIÓN
// ════════════════════════════════════════

Route::get('/registro',  [AuthController::class, 'showRegistro'])->name('registro');
Route::post('/registro', [AuthController::class, 'register'])->name('registro.store');

Route::get('/login',     [AuthController::class, 'showLogin'])->name('login');
Route::post('/login',    [AuthController::class, 'login'])->name('login.store');

Route::post('/logout',   [AuthController::class, 'logout'])->name('logout');

// ════════════════════════════════════════
// PORTAL CLIENTE — requiere sesión
// ════════════════════════════════════════

Route::middleware('auth.cosm')->group(function () {

    // Dashboard
    Route::get('/dashboard', [CitaController::class, 'dashboard'])->name('dashboard');

    // Agendar
    Route::get('/agendar',  [CitaController::class, 'showAgendar'])->name('agendar');
    Route::post('/agendar', [CitaController::class, 'store'])->name('agendar.store');

    // Mis citas
    Route::get('/mis-citas', [CitaController::class, 'misCitas'])->name('mis-citas');

    // Editar cita
    Route::get('/citas/{id}/editar', [CitaController::class, 'edit'])->name('citas.edit');
    Route::put('/citas/{id}',        [CitaController::class, 'update'])->name('citas.update');

    // Cancelar cita
    Route::delete('/citas/{id}', [CitaController::class, 'destroy'])->name('citas.destroy');
});

// ════════════════════════════════════════
// PANEL ADMIN — requiere sesión + rol admin
// ════════════════════════════════════════

Route::middleware('auth.admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Dashboard admin
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

        // ── Clientes ──────────────────────────
        Route::get('/clientes',         [AdminController::class, 'clientes'])->name('clientes');
        Route::delete('/clientes/{id}', [AdminController::class, 'destroyCliente'])->name('clientes.destroy');

        // ── Servicios ─────────────────────────
        Route::get('/servicios',              [AdminController::class, 'servicios'])->name('servicios');
        Route::get('/servicios/crear',        [AdminController::class, 'createServicio'])->name('servicios.create');
        Route::post('/servicios',             [AdminController::class, 'storeServicio'])->name('servicios.store');
        Route::get('/servicios/{id}/editar',  [AdminController::class, 'editServicio'])->name('servicios.edit');
        Route::put('/servicios/{id}',         [AdminController::class, 'updateServicio'])->name('servicios.update');
        Route::delete('/servicios/{id}',      [AdminController::class, 'destroyServicio'])->name('servicios.destroy');

        // ── Disponibilidad ────────────────────
        Route::get('/disponibilidad',         [AdminController::class, 'disponibilidad'])->name('disponibilidad');
        Route::post('/disponibilidad',        [AdminController::class, 'storeDisponibilidad'])->name('disponibilidad.store');
        Route::delete('/disponibilidad/{id}', [AdminController::class, 'destroyDisponibilidad'])->name('disponibilidad.destroy');

        // ── Citas ─────────────────────────────
        Route::get('/citas',         [AdminController::class, 'citas'])->name('citas');
        Route::delete('/citas/{id}', [AdminController::class, 'destroyCita'])->name('citas.destroy');
    });
