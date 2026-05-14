<?php

return [

    'defaults' => [
        'guard'     => 'web',
        'passwords' => 'clientes',
    ],

    'guards' => [
        'web' => [
            'driver'   => 'session',
            'provider' => 'clientes',
        ],
    ],

    'providers' => [
        'clientes' => [
            'driver' => 'eloquent',
            'model'  => App\Models\Cliente::class,
        ],
    ],

    'passwords' => [
        'clientes' => [
            'provider' => 'clientes',
            'table'    => 'password_reset_tokens',
            'expire'   => 60,
            'throttle' => 1,
        ],
    ],

    'password_timeout' => 10800,

];
