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

    public function obtenerUsuarioPorUsuario($usuario)
    {
        $sql = "SELECT * FROM usuario WHERE usuario = :usuario";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindValue(':usuario', $usuario);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
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


    public function listarUsuario()
    {
        $sql = "SELECT * FROM usuario";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function mostrarUsuario($id_usuario)
    {
        $sql = "SELECT * FROM usuario WHERE id_usuario = :id_usuario";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id_usuario', $id_usuario);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizarUsuario($nombre, $correo, $usuario, $contrasena, $rol)
    {
        $sql = "UPDATE usuario SET nombre = :nombre, correo = :correo, usuario = :usuario, contrseña = :contrasena, rol = :rol WHERE id_usuario = :id_usuario";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id_usuario', $id_usuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':corre', $correo);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contraseña', $contrasena);
        $stmt->bindParam(':rol', $rol);

        $stmt->execute();
    }

    public function eliminarUsuario($id_usuario)
    {
        $sql = "DELETE FROM usuario WHERE id_usuario = :id_usuario";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':id_usuario', $id_usuario);

        $stmt->execute();
    }
}
