<?php
require_once 'connection.php';

class UsuarioModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("
            SELECT 
                usuario.*, 
                empleado.especialidad, 
                empleado.contratacion 
            FROM usuario 
            LEFT JOIN empleado ON usuario.id_usu = empleado.id_usuario
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($nombre, $email, $telefono, $direccion, $rol = 'cliente') {
        $stmt = $this->conn->prepare("INSERT INTO usuario (nombre, email, telefono, direccion, rol) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $email, $telefono, $direccion, $rol]);
    }

    public function login($email, $telefono) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE email = ? AND telefono = ?");
        $stmt->execute([$email, $telefono]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function eliminar($id_usu) {
        // Eliminar empleado si existe
        $stmt = $this->conn->prepare("DELETE FROM empleado WHERE id_usuario = ?");
        $stmt->execute([$id_usu]);

        // Ahora sí eliminar usuario
        $stmt = $this->conn->prepare("DELETE FROM usuario WHERE id_usu = ?");
        return $stmt->execute([$id_usu]);
    }

    public function getByRol($rol) {
        $stmt = $this->conn->prepare("SELECT * FROM usuario WHERE rol = ?");
        $stmt->execute([$rol]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function update($id_usu, $nombre, $email, $telefono, $direccion, $rol) {
        $stmt = $this->conn->prepare("
            UPDATE usuario 
            SET nombre = ?, email = ?, telefono = ?, direccion = ?, rol = ?
            WHERE id_usu = ?
        ");
        return $stmt->execute([$nombre, $email, $telefono, $direccion, $rol, $id_usu]);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("
            SELECT 
                usuario.*, 
                empleado.especialidad, 
                empleado.contratacion 
            FROM usuario 
            LEFT JOIN empleado ON usuario.id_usu = empleado.id_usuario
            WHERE usuario.id_usu = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
