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

    public function agregarReunion($fecha, $hora_inicio, $hora_finalizacion, $lugar, $estado,$id_usuario)
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

    public function mostrarReunion($id_reunion)
    {
        $sql = "SELECT * FROM reunion  WHERE id_reunion = :id_reunion";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id', $id_reunion);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function actualizarReunion($fecha, $hora_inicio, $hora_finalizacion, $lugar, $estado,$id_usuario)
    {
        $sql = "UPDATE reunion SET fecha = :fecha, hora_inicio = :hora_inicio, hora_finalizacion = :hora_finalizacion, lugar = :lugar, estado = :estado, id_usuario = :id_usario WHERE id_reunion = :id_reunion";

        $stmt = $this->getConexion()->prepare($sql);
    
        $stmt->bindParam(':id_reunion', $id_reunion);
        $stmt->bindParam(':fecha', $fecha);
        $stmt->bindParam(':hora_inicio', $hora_inicio);
        $stmt->bindParam(':hora_finalizacion', $hora_finalizacion);
        $stmt->bindParam(':lugar', $lugar);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id_usuario', $id_usuario);
    
        $stmt->execute();
    }
    
    public function eliminarReunion($id_reunion)
    {
        
        $sql = "DELETE FROM reunion WHERE id_reunion = :id_reunion";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id_reunion', $id_reunion);

        $stmt->execute();
        
    }
}
