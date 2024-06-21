<?php

$routes = [
    'GET' => [
        '/' => 'HomeController@index',
        '/users' => 'UsuariosControlador@index', // Ruta con middleware
        '/users/(\d+)' => 'UserController@show', // Ruta con parámetro de ID
    ],
    'POST' => [
        '/users/create' => 'UserController@create',
    ],
    'DELETE' => [
        '/users/(\d+)' => 'UserController@delete@authorized', // Ruta con parámetro de ID
    ],
];