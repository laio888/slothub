<?php

use Illuminate\Support\Str;

return [

    // Driver: file
    'driver' => env('SESSION_DRIVER', 'file'),

    // Duración de 2 horas
    'lifetime' => env('SESSION_LIFETIME', 120),

    // Se elimina la sesion al cerrar el navegador
    'expire_on_close' => env('SESSION_EXPIRE_ON_CLOSE', false),

    // Encriptar contenido de la sesion
    'encrypt' => env('SESSION_ENCRYPT', false),

    // En donde se guardan los datos.=
    'files' => storage_path('framework/sessions'),

    'connection' => env('SESSION_CONNECTION'),
    'table'      => env('SESSION_TABLE', 'sessions'),
    'store'      => env('SESSION_STORE'),
    'lottery'    => [2, 100],
    'cookie'     => env('SESSION_COOKIE', Str::slug(env('APP_NAME', 'laravel'), '_') . '_session'),
    'path'       => '/',
    'domain'     => env('SESSION_DOMAIN'),
    'secure'     => env('SESSION_SECURE_COOKIE', false),
    'http_only'  => env('SESSION_HTTP_ONLY', true),
    'same_site'  => env('SESSION_SAME_SITE', 'lax'),
    'partitioned'=> false,

];
