<?php

$routes = [
    'GET' => [
        '/' => 'HomeController@index',
        '/users' => 'UsuariosControlador@index', // Ruta con middleware
        '/users/(\d+)' => 'UsuariosControlador@show', // Ruta con parámetro de ID
    ],
    'POST' => [
        '/users/create' => 'UserController@create',
        '/actas' => 'ActasControlador@store'
    ],
    'DELETE' => [
        '/users/(\d+)' => 'UserController@delete@authorized', // Ruta con parámetro de ID
    ],
];