<?php

namespace controladores;

use modelos\Usuario;

class UsuariosControlador 
{
    public function index()
    {
        $usuario = new Usuario();
        $usuario = $usuario->listarUsuario();

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Listado de actas',
            'data' => $usuario
        ]);
    }

    public function show($requuest,$id)
    {
        $usario = new Usuario();
        $usuario = $usario->mostrarUsuario($id);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Acta con ID: ' . $id,
            'data' => $usario
        ]);
    }

    public function store($requestData)
    {
        $usuario = new Usuario();
        
        $usuario->registrarUsuario(
            $requestData['nombre'], 
            $requestData['correo'], 
            $requestData['rol'],
            $requestData['usuario'],
            $requestData['contraseña']
        );

        http_response_code(201);
        return json_encode([
            'status' => 201,
            'message' => 'Usuario creada'
        ]);
    }

    public function update($nombre, $correo, $usuario, $contrasena, $rol)
    {
        $usuario = new Usuario();
        $usuario->actualizarUsuario($nombre, $correo, $usuario, $contrasena, $rol);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Usuario actualizada'
        ]);
    }

    public function destroy($id_usuario)
    {
        $usuario = new Usuario();
        $usuario->eliminarUsuario($id_usuario);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Usuario eliminada'
        ]);
    }
}