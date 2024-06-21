<?php

namespace controladores;

class UsuariosControlador 
{
    public function index(){

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Listado de usuarios'
        ]);
    }

    public function show($id){

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Usuario con ID: ' . $id
        ]);
    }
}