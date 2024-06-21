<?php

namespace modelos;

use PDO;

class Reunion extends Conexion
{

    private $conexion;

    public function __construct()
    {
        parent::__construct();
    }

    public function agregarReunion($fecha, $hora_inicio, $hora_finalizacion, $lugar, $estado)
    {
        $sql = "INSERT INTO reunion(fecha, hora_inicio, hora_finalizacion, lugar, estado, id_usuario) VALUES (:fecha, :hora_inicio, :hora_finalizacion, :lugar, :estado, :id_usuario)";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_finalizacion', $hora_finalizacion);
        $stmt->bindParam(':lugar', $lugar);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id_usuario', $id_usuario);

        $stmt->execute();
        
    }
    public function listarReunion()
    {
        $sql = "SELECT * FROM reunion";

        $stmt = $this->getConexion()->prepare($sql);
        $stmt ->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 

    public function actualizarReunion($fecha, $hora_inicio, $hora_finalizacion, $lugar, $estado)
    {
        $sql = "UPDATE reunion SET fecha = :fecha, hora_inicio = :hora_inicio, hora_finalizacion = :hora_finalizacion, lugar = :lugar, estado = :estado WHERE id_reunion = :id_reunion";

        $stmt = $this->getConexion()->prepare($sql);
    
        $stmt->bindParam(':id_reunion', $id_reunion);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_finalizacion', $hora_finalizacion);
        $stmt->bindParam(':lugar', $lugar);
        $stmt->bindParam(':estado', $estado);
    
        $stmt->execute();
    }
    
    public function eliminarReunion($fecha, $hora_inicio, $hora_finalizacion, $lugar, $estado)
    {
        
        $sql = "DELETE FROM reunion WHERE id_reunion = :id_reunion";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id_reunion', $id_reunion);

        $stmt->execute();
        
    }
}
