<?php
namespace controladores;

require_once 'modelos/Reunion.php';

use modelos\Reunion;

class ReunionesControlador 
{
    public function index(){

        $reunion = new Reunion();
        $reunion = $reunion->listarReunion();

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Listado de reunion',
            'data' => $reunion
        ]);
    }

    public function show($requesr, $id_reunion){

        $reunion = new Reunion();
        $reunion = $reunion->mostrarReunion($id_reunion);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Reunion con ID: ' . $id_reunion,
            'data' => $reunion
        ]);
    }

    
    public function store($requestData)
    {
        $reunion = new Reunion();

        //$titulo, $fecha, $hora_inicio, $hora_finalizacion, $lugar, $estado, $id_usuario
        
        $reunion->agregarReunion(
            $requestData['titulo'],
            $requestData['fecha'],  
            $requestData['hora_inicio'],
            $requestData['hora_finalizacion'],
            $requestData['lugar'],
            $requestData['estado'],
            $requestData['id_usuario']
        );

        http_response_code(201);
        return json_encode([
            'status' => 201,
            'message' => 'Reunion creada'
        ]);
    }

 
    public function update($requestData, $id_reunion)
    {
        $reunion = new Reunion();

        $reunion->actualizarReunion(
            $id_reunion,
            $requestData['fecha'],
            $requestData['hora_inicio'],
            $requestData['hora_finalizacion'],
            $requestData['lugar'],
            $requestData['estado'],
            $requestData['id_usuario'],
            $requestData['titulo']
        );

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Reunion actualizada'
        ]);
    }
   

    public function destroy($requestData, $id_reunion)
    {
        $reunion = new Reunion();

        $reunion->eliminarReunion($id_reunion);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Reunion eliminada',
            'id' => $id_reunion
        ]);
    }
}