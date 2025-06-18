<?php
require_once 'models/connection.php';

class ConsultaModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("
            SELECT consultas.*, animales.nombre AS animal_nombre, empleados.nombre AS empleado_nombre 
            FROM consultas
            JOIN animales ON consultas.id_animal = animales.id
            JOIN empleados ON consultas.id_empleado = empleados.id
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnimales() {
        $stmt = $this->conn->query("SELECT id, nombre FROM animales");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmpleados() {
        $stmt = $this->conn->query("SELECT id, nombre FROM empleados");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($fecha, $descripcion, $id_animal, $id_empleado) {
        $stmt = $this->conn->prepare("
            INSERT INTO consultas (fecha, descripcion, id_animal, id_empleado)
            VALUES (?, ?, ?, ?)
        ");
        return $stmt->execute([$fecha, $descripcion, $id_animal, $id_empleado]);
    }
}
