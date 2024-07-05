<?php

$routes = [
    'GET' => [
        '/auth/user' => 'AuthControlador@getAuthUser@authorized',
        '/users' => 'UsuariosControlador@index', // Ruta con middleware
        '/users/(\d+)' => 'UsuariosControlador@show', // Ruta con parámetro de ID
        '/actas' => 'ActasControlador@index@authorized',//por defecto para el methdo get
        '/reuniones' => 'ReunionesControlador@index@authorized',
        '/reuniones/(\d+)' => 'ReunionesControlador@show@authorized',
        '/actas/(\d+)' => 'ActasControlador@show@authorized',
        '/actas/reuniones/(\d+)' => 'ActasControlador@getBYReunion',
        '/compromisos'=>'CompromisosControlador@index',
        '/compromisos/(\d+)'=>'CompromisosControlador@show',
        '/compromisos/acta/(\d+)' => 'CompromisosControlador@getBYActa',
    ],
    'POST' => [
        '/login' => 'AuthControlador@login',
        '/register' => 'AuthControlador@register',
        '/actas' => 'ActasControlador@store',
        '/users/create' => 'UserController@create',
        '/reuniones' => 'ReunionesControlador@store',
        '/compromisos'=> 'CompromisosControlador@store',
    ],
    'PUT' => [
        '/actas/(\d+)' => 'ActasControlador@update',
        '/reuniones/(\d+)' => 'ReunionesControlador@update@authorized',
        '/compromisos/(\d+)'=>'CompromisosControlador@update@authorized',

    ],
    'DELETE' => [
        '/users/(\d+)' => 'UserController@delete@authorized', // Ruta con parámetro de ID
        '/actas/(\d+)' => 'ActasControlador@destroy',
        '/reuniones/(\d+)' => 'ReunionesControlador@destroy@authorized',
        '/compromisos/(\d+)'=>'CompromisosControlador@destroy@authorized',
    ],
];