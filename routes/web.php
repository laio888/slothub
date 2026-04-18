<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.home');
})->name('home');

Route::get('/servicios', function () {
    return view('pages.servicios');
})->name('servicios');

Route::get('/como-funciona', function () {
    return view('pages.como-funciona');
})->name('como-funciona');

Route::get('/aliados', function () {
    return view('pages.aliados');
})->name('aliados');

Route::get('/contacto', function () {
    return view('pages.contacto');
})->name('contacto');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.register');
})->name('register');
