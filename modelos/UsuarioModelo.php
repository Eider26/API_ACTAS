<?php

class UsuarioModelo {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function verificarUsuario($usuario, $contrasena) {
        $stmt = $this->conexion->prepare("SELECT contraseña FROM usuario WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $fila = $resultado->fetch_assoc();
            // Verificar la contraseña usando password_verify
            if (password_verify($contrasena, $fila['contraseña'])) {
                return true;
            }
        }
        return false;
    }

    public function registrarUsuario($nombre, $correo, $usuario, $contrasena, $rol) {
        $hash_contrasena = password_hash($contrasena, PASSWORD_DEFAULT);
        $stmt = $this->conexion->prepare("INSERT INTO usuario (nombre, correo, usuario, contraseña, rol) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $nombre, $correo, $usuario, $hash_contrasena, $rol);
        if ($stmt->execute()) {
            return ["status" => "success", "message" => "Usuario registrado exitosamente"];
        } else {
            return ["status" => "error", "message" => "Error al registrar usuario"];
        }
    }
}
