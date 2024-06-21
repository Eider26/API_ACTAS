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
        $sql = "SELECT * FROM acta";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarActa($id)
    {
        $sql = "SELECT * FROM acta WHERE id_acta = :id";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id', $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarActa($tema, $contenido, $tipo, $id_reunion, $id)
    {
        $sql = "UPDATE acta SET tema = :tema, contenido = :contenido, tipo = :tipo, id_reunion = :id_reunion WHERE id_acta = :acta_id";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':tema', $tema);
        $stmt->bindParam(':contenido', $contenido);
        $stmt->bindParam(':tipo', $tipo);
        $stmt->bindParam(':id_reunion', $id_reunion);
        $stmt->bindParam(':acta_id', $id);


        $stmt->execute();
    }

    public function eliminarActa($id)
    {
        $sql = "DELETE FROM acta WHERE id_acta = :id_acta";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id_acta', $id);

        $stmt->execute();
    }
}       