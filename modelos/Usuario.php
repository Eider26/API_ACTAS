<?php

namespace modelos;


require_once 'Conexion.php';

use PDO;

class Usuario extends Conexion
{

    function __construct()
    {
        parent::__construct();
    }

    public function verificarUsuario($usuario, $contrasena)
    {
        /*$stmt = $this->getConexion()->prepare("SELECT contraseña FROM usuario WHERE usuario = :id");
        $stmt->bindParam(':id', )*/
    }

    public function registrarUsuario($nombre, $correo, $usuario, $contrasena, $rol)
    {
        $sql = "INSERT INTO usuario(nombre, rol, usuario, correo, contrasena) VALUES (:nombre, :rol, :usuario, :correo, :contrasena)";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindValue(':nombre', $nombre);
        $stmt->bindValue(':correo', $correo);
        $stmt->bindValue(':usuario', $usuario);
        $stmt->bindValue(':contrasena', $contrasena);
        $stmt->bindValue(':rol', $rol);

        $stmt->execute();
    }
}
