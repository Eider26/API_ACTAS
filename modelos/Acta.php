<?php

namespace modelos;

require_once 'Conexion.php';

use PDO;

class Acta extends Conexion
{

    public function __construct()
    {
        parent::__construct();
    }

    public function agregarActa($tema, $contenido, $tipo, $id_reunion)
    {
        $sql = "INSERT INTO acta(tema, contenido, tipo, id_reunion) VALUES (:tema, :contenido, :tipo, :id_reunion)";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':tema', $tema);
        $stmt->bindParam(':contenido', $contenido);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':id_reunion', $id_reunion);

        $stmt->execute();
    }

    public function listarActas()
    {
        $sql = "SELECT * FROM actas";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarActa($id)
    {
        $sql = "SELECT * FROM actas WHERE id = :id";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarActa($id, $id_reunion, $id_usuario, $descripcion)
    {
        $sql = "UPDATE actas SET id_reunion = :id_reunion, id_usuario = :id_usuario, descripcion = :descripcion WHERE id = :id";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':id_reunion', $id_reunion);
        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':descripcion', $descripcion);

        $stmt->execute();
    }

    public function eliminarActa($id)
    {
        $sql = "DELETE FROM actas WHERE id = :id";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();
    }
}       