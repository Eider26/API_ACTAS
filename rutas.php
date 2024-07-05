<?php

$routes = [
    'GET' => [
        '/auth/user' => 'AuthControlador@getAuthUser@authorized',
        '/users' => 'UsuariosControlador@index', // Ruta con middleware
        '/users/(\d+)' => 'UsuariosControlador@show', // Ruta con parámetro de ID
        '/actas' => 'ActasControlador@index@authorized',//por defecto para el methdo get
        '/reuniones' => 'ReunionesControlador@index@authorized',
        '/reuniones/(\d+)' => 'ReunionesControlador@index@authorized',
        '/actas/(\d+)' => 'ActasControlador@show@authorized',
    ],
    'POST' => [
        '/login' => 'AuthControlador@login',
        '/register' => 'AuthControlador@register',
        '/actas' => 'ActasControlador@store',
        '/users/create' => 'UserController@create',
        '/reuniones' => 'ReunionesControlador@store',
    ],
    'PUT' => [
        '/actas/(\d+)' => 'ActasControlador@update',
        '/reuniones/(\d+)' => 'ReunionesControlador@update@authorized',

    ],
    'DELETE' => [
        '/users/(\d+)' => 'UserController@delete@authorized', // Ruta con parámetro de ID
        '/actas/(\d+)' => 'ActasControlador@destroy',
        '/reuniones/(\d+)' => 'ReunionesControlador@destroy@authorized',
    ],
];