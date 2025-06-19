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
            JOIN animales ON consultas.id_animal = animales.id_ani
            JOIN empleados ON consultas.id_empleado = empleados.id_emp
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnimalesPorCliente($id_cliente) {
        $stmt = $this->conn->prepare("SELECT id_ani, nombre, especie FROM animales WHERE id_cliente = ?");
        $stmt->execute([$id_cliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmpleados() {
        $stmt = $this->conn->query("SELECT id_emp, nombre, especialidad FROM empleados");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($fecha, $descripcion, $id_animal, $id_empleado, $estado = false) {
        $stmt = $this->conn->prepare(
            "INSERT INTO consultas (fecha, descripcion, id_animal, id_empleado, estado) 
             VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$fecha, $descripcion, $id_animal, $id_empleado, $estado]);
    }

    public function getByAnimal($id_animal) {
        $stmt = $this->conn->prepare(
            "SELECT c.*, e.nombre AS nombre_empleado
             FROM consultas c
             JOIN empleados e ON c.id_empleado = e.id_emp
             WHERE c.id_animal = ?"
        );
        $stmt->execute([$id_animal]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnimalById($id_animal) {
        $stmt = $this->conn->prepare("SELECT * FROM animales WHERE id_ani = ?");
        $stmt->execute([$id_animal]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByAnimalAndCliente($id_animal, $id_cliente) {
        $stmt = $this->conn->prepare("
            SELECT c.*, e.nombre AS nombre_empleado
            FROM consultas c
            JOIN empleados e ON c.id_empleado = e.id_emp
            JOIN animales a ON c.id_animal = a.id_ani
            WHERE a.id_ani = ? AND a.id_cliente = ?
        ");
        $stmt->execute([$id_animal, $id_cliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
