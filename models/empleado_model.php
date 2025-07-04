<?php
require_once 'connection.php';

class EmpleadoModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAllEmpleado() {
        $stmt = $this->conn->query("SELECT * FROM empleado");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function saveEmpleado($especialidad, $contratacion, $id_usuario) {
        $stmt = $this->conn->prepare("INSERT INTO empleado (especialidad, contratacion, id_usuario) VALUES (?, ?, ?)");
        return $stmt->execute([$especialidad, $contratacion, $id_usuario]);
    }

    public function getByUsuarioId($id_usuario) {
        $stmt = $this->conn->prepare("SELECT * FROM empleado WHERE id_usuario = ?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByUsuario($id_usuario) {
        $stmt = $this->conn->prepare("SELECT * FROM empleado WHERE id_usuario = ?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function updateEspecialidad($id_emp, $nuevaEspecialidad) {
        $stmt = $this->conn->prepare("UPDATE empleado SET especialidad = ? WHERE id_emp = ?");
        return $stmt->execute([$nuevaEspecialidad, $id_emp]);
    }
    
    
}
