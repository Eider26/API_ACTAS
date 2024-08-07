<?php

namespace controladores;

require_once 'modelos/Compromiso.php';

use modelos\Compromiso;

class CompromisosControlador 
{
    public function index()
    {
        $compromiso = new Compromiso();
        $compromiso = $compromiso->listarCompromiso();

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Listado de Compromiso',
            'data' => $compromiso
        ]);
    }

    public function show($requuest,$id)
    {
        $compromiso = new Compromiso();
        $compromiso = $compromiso->mostrarCompromiso($id);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Compromiso con ID: ' . $id,
            'data' => $compromiso
        ]);
    }

    public function store($requestData)
    {
        $compromiso = new Compromiso();
        
        $compromiso->agregarCompromiso(
            $requestData['descripcion'], 
            $requestData['fecha_limite'], 
            $requestData['estado'],
            $requestData['id_acta']
        );

        http_response_code(201);
        return json_encode([
            'status' => 201,
            'message' => 'Compromiso creado'
        ]);
    }

    public function update($request,$id)
    {
        $compromiso = new Compromiso();

        $compromiso->actualizarCompromiso(
            $id,
            $request['descripcion'], 
            $request['fecha_limite'], 
            $request['estado'],
            $request['id_acta'],
           
        );

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Compromiso actualizado'
        ]);
    }

    public function destroy($request, $id)
    {
        $compromiso = new Compromiso();
        $compromiso->eliminarCompromiso($id);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'Compromiso eliminado'
        ]);
    }
    public function getBYActa ($requesr, $id_acta){

        $compromiso = new Compromiso();
        $compromisodata = $compromiso->getByActa($id_acta);

        http_response_code(200);
        return json_encode([
            'status' => 200,
            'message' => 'actas con ID: ' . $id_acta,
            'data' => $compromisodata
        ]);
    }
} 
