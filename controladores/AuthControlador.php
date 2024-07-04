<?php

namespace controladores;

require_once 'modelos/Usuario.php';
require_once 'modelos/Jwt.php';

use modelos\Jwt;
use modelos\Usuario;

class AuthControlador
{

    public function getAuthUser()
    {
        $jwt = new Jwt($_ENV["SECRET_KEY"]);

        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];

        preg_match('/Bearer\s(\S+)/', $authHeader, $tokenMatch);

        $payload = $jwt->decode($tokenMatch[1]);

        $usuario = new Usuario();

        $usuario = $usuario->mostrarUsuario($payload['sub']);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Usuario autenticado',
            'data' => $usuario
        ]);
    }

    public function login($request)
    {

        $usuario = new Usuario();

        $usuario = $usuario->obtenerUsuarioPorUsuario($request['usuario']);

        if (!$usuario) {
            http_response_code(404);
            return json_encode([
                'status' => 404,
                'message' => 'Usuario no encontrado'
            ]);
        }

        if (!password_verify($request['contrasena'], $usuario['contrasena'])) {
            http_response_code(401);
            return json_encode([
                'status' => 401,
                'message' => 'Autenticación fallida: contraseña incorrecta'
            ]);
        }

        $jwt = new Jwt($_ENV["SECRET_KEY"]);

        $access_token = $jwt->encode([
            'sub' => $usuario['id_usuario'],
            'name' => $usuario['nombre'],
            'exp' => time() + 60 * 120
        ]);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Autenticación correcta',
            'access_token' => $access_token
        ]);
    }

    public function register($request)
    {

        $usuarios = new Usuario();

        $usuarios->registrarUsuario(
            $request['nombre'],
            $request['correo'],
            $request['usuario'],
            password_hash($request['contrasena'], PASSWORD_DEFAULT)
        );

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Usuario registrado'
        ]);
    }
}
