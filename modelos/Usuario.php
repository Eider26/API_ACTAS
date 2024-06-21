<?php

namespace modelos;

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
        $sql = "INSERT INTO usuarios(nombre, rol, usuario, correo, contraseña) VALUES (:nombre, :rol, :usuario, :correo, :contraseña)";

        $stmt = $this->getConexion()->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':rol', $rol);

        $stmt->execute();
    }
}
