<?php

namespace modelos;

require_once 'Conexion.php';

use PDO;

class Compromiso extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function agregarCompromiso($descripcion, $fecha_limite, $estado, $id_acta)
    {
        $sql = "INSERT INTO compromiso(descripcion, fecha_limite, estado, id_acta) VALUES (:descripcion, :fecha_limite, :estado, :id_acta)";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_limite', $fecha_limite);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id_acta', $id_acta);

        $stmt->execute();
    }

    public function listarCompromiso()
    {
        $sql = "SELECT * FROM compromiso";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarCompromiso($id)
    {
        $sql = "SELECT * FROM compromiso WHERE id_compromiso = :id_compromiso";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id_compromiso', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarCompromiso($id, $descripcion, $fecha_limite, $estado, $id_acta)
    {
        $sql = "UPDATE compromiso SET 
                    descripcion = :descripcion, 
                    fecha_limite = :fecha_limite, 
                    estado = :estado, 
                    id_acta = :id_acta 
                WHERE id_compromiso = :id_compromiso";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_limite', $fecha_limite);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id_acta', $id_acta);
        $stmt->bindParam(':id_compromiso', $id);

        $stmt->execute();
    }

    public function eliminarCompromiso($id)
    {
        $sql = "DELETE FROM compromiso WHERE id_compromiso = :id_compromiso";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id_compromiso', $id);

        $stmt->execute();
    }

    
    public function getByActa($id_acta)
    {
        // Definir la consulta SQL
        $sql = "SELECT * FROM compromiso WHERE id_acta = :id_acta";

        // Preparar la consulta
        $stmt = $this->getConexion()->prepare($sql);

        // Vincular el parámetro id_acta
        $stmt->bindParam(':id_acta', $id_acta);

        // Ejecutar la consulta
        $stmt->execute();

        // Obtener los resultados como un array asociativo
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Retornar los resultados
        return $result;
    }
}
