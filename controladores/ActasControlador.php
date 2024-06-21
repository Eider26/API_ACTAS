<?php

namespace controladores;

require_once 'modelos/Acta.php';

use modelos\Acta;

class ActasControlador
{
    public function index()
    {
        $acta = new Acta();
        $actas = $acta->listarActas();

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Listado de actas',
            'data' => $actas
        ]);
    }

    public function show($id)
    {
        $acta = new Acta();
        $acta = $acta->mostrarActa($id);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Acta con ID: ' . $id,
            'data' => $acta
        ]);
    }

    public function store($requestData)
    {
        $acta = new Acta();
        
        $acta->agregarActa(
            $requestData['tema'], 
            $requestData['contenido'], 
            $requestData['tipo'],
            $requestData['id_reunion']
        );

        http_response_code(201);
        return json_encode([
            'status' => 201,
            'message' => 'Acta creada'
        ]);
    }

    public function update($id, $id_reunion, $id_usuario, $descripcion)
    {
        $acta = new Acta();
        $acta->actualizarActa($id, $id_reunion, $id_usuario, $descripcion);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Acta actualizada'
        ]);
    }

    public function destroy($id)
    {
        $acta = new Acta();
        $acta->eliminarActa($id);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Acta eliminada'
        ]);
    }
}