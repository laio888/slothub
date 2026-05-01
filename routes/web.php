<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'inicio')->name('inicio');

Route::view('/servicios', 'servicios')->name('servicios');

Route::view('/agendar', 'agendar')->name('agendar');

Route::view('/login', 'login')->name('login');
