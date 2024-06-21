<?php

namespace modelos;

class Reunion extends Conexion
{

    private $conexion;

    public function __construct()
    {
        parent::__construct();
    }

    public function agregarReunion($fecha, $hora_inicio, $hora_finalizacion, $lugar, $estado)
    {
        
    }
}
