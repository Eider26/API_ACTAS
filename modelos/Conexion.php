<?php

namespace modelos;

use PDO;
use PDOException;

class Conexion
{
    private $host = "localhost";
    private $usuario = "root";
    private $password = "";
    private $db = "dw_2";
    private $conexion;

    public function __construct()
    {
        try {
            $this->conexion = new PDO("mysql:host=$this->host;dbname=$this->db", $this->usuario, $this->password);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function getConexion()
    {
        return $this->conexion;
    }
}
