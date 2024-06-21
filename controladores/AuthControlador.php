<?php

namespace controladores;

require_once 'modelos/Usuario.php';

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

        $usuarios = new Usuario();

        $usuarios->registrarUsuario(
            $request['nombre'],
            $request['correo'],
            $request['usuario'],
            password_hash($request['contrasena'], PASSWORD_DEFAULT),
            $request['rol']
        );

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Usuario registrado'
        ]);
    }
}