<?php

namespace controladores;

use modelos\Usuario;

class AuthControlador 
{
    public function login($request){

        $usuarios = new Usuario();

        

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Listado de usuarios'
        ]);
    }

    public function register($request){

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Usuario con ID: ' . $id
        ]);
    }
}