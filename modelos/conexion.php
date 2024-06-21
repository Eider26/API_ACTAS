<?php

class Conexion {
    private $host = "localhost";
    private $usuario = "root";
    private $password = "";
    private $db = "dw_2";
    private $conexion;

    public function __construct() {
        $this->conexion = new mysqli($this->host, $this->usuario, $this->password, $this->db);

        if ($this->conexion->connect_error) {
            die("Error de conexión: " . $this->conexion->connect_error);
        }
    }

    public function getConexion() {
        return $this->conexion;
    }
    public function conexionExitosa() {
        // Verificar si hay un error de conexión
        if ($this->conexion->connect_errno) {
            return false; // Si hay un error, la conexión no fue exitosa
        } else {
            return true; // Si no hay error, la conexión fue exitosa
        }
    }

}



