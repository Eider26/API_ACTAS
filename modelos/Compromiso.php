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
        $sql = "INSERT INTO compromiso(descripcion, fecha_limite, estado, id_acta) VALUES (:descripcion, :fecha_limite, :estdo, :id_acta)";

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

    public function actualizarCompromiso($descripcion, $fecha_limite, $estado, $id_acta)
    {
        $sql = "UPDATE compromiso SET descripcion = :descripcion, fecha_limite = :fecha_limite, estao = :estdo, id_acta = :id_acta WHERE id_compromiso = :id_compromiso";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':fecha_limite', $fecha_limite);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':id_compromiso', $id_compromiso);
        

        $stmt->execute();
    }

    public function eliminarCompromiso($id)
    {
        $sql = "DELETE FROM compromiso WHERE id_compromiso = :id_compromiso";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id_compromiso', $id);

        $stmt->execute();
    }
}