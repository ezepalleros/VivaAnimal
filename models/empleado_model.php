<?php
require_once 'connection.php';

class EmpleadoModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM empleados");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($nombre, $especialidad, $contratacion, $id_cliente) {
        $stmt = $this->conn->prepare("INSERT INTO empleados (nombre, especialidad, contratacion, id_cliente) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nombre, $especialidad, $contratacion, $id_cliente]);
    }
}
