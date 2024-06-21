<?php

$routes = [
    'GET' => [
        '/' => 'HomeController@index',
        '/users' => 'UsuariosControlador@index', // Ruta con middleware
        '/users/(\d+)' => 'UsuariosControlador@show', // Ruta con parámetro de ID
        '/actas' => 'ActasControlador@index',
        '/actas/(\d+)' => 'ActasControlador@show',
    ],
    'POST' => [
        '/login' => 'AuthControlador@login',
        '/register' => 'AuthControlador@register',
        '/actas' => 'ActasControlador@store',
        '/users/create' => 'UserController@create',
    ],
    'PUT' => [
        '/actas/(\d+)' => 'ActasControlador@update',
    ],
    'DELETE' => [
        '/users/(\d+)' => 'UserController@delete@authorized', // Ruta con parámetro de ID
        '/actas/(\d+)' => 'ActasControlador@destroy'
    ],
];