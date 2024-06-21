<?php
class ReunionModelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function agregarReunion($fecha, $hora_inicio, $hora_finalizacion, $lugar, $estado) {
        $stmt = $this->conexion->prepare("INSERT INTO reunion (fecha, hora_inicio, hora_finalizacion, lugar, estado) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $fecha, $hora_inicio, $hora_finalizacion, $lugar, $estado);
        if ($stmt->execute()) {
            return true; // La reunión fue agregada exitosamente
        } else {
            return false; // Hubo un error al agregar la reunión
        }
    }
}

