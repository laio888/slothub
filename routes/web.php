<?php

use Illuminate\Support\Facades\Route;

// ── Páginas públicas ──────────────────────────────
Route::get('/', fn() => view('inicio'))->name('inicio');
Route::get('/servicios', fn() => view('servicios'))->name('servicios');
Route::get('/registro',  fn() => view('registro'))->name('registro');
Route::get('/login',     fn() => view('login'))->name('login');

// ── Páginas del portal (protección real viene con backend) ──
Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
Route::get('/agendar',   fn() => view('agendar'))->name('agendar');
Route::get('/mis-citas', fn() => view('mis-citas'))->name('mis-citas');
