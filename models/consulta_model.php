<?php
require_once 'models/connection.php';

class ConsultaModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("
            SELECT consulta.*, animal.nombre AS animal_nombre, empleado.nombre AS empleado_nombre 
            FROM consulta
            JOIN animal ON consulta.id_animal = animal.id_ani
            JOIN empleado ON consulta.id_empleado = empleado.id_emp
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnimalesPorUsuario($id_usuario) {
        $stmt = $this->conn->prepare("SELECT id_ani, nombre, especie FROM animal WHERE id_usuario = ?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEmpleados() {
    $sql = "SELECT e.id_emp, u.nombre, e.especialidad
            FROM empleado e
            JOIN usuario u ON e.id_usuario = u.id_usu";
    $stmt = $this->conn->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function save($fecha, $descripcion, $id_animal, $id_empleado, $estado = false) {
        $stmt = $this->conn->prepare(
            "INSERT INTO consulta (fecha, descripcion, id_animal, id_empleado, estado) 
             VALUES (?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$fecha, $descripcion, $id_animal, $id_empleado, $estado]);
    }

    public function getByAnimal($id_animal) {
    $sql = "SELECT c.*, u.nombre AS nombre_empleado
            FROM consulta c
            JOIN empleado e ON c.id_empleado = e.id_emp
            JOIN usuario u ON e.id_usuario = u.id_usu
            WHERE c.id_animal = ?";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([$id_animal]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAnimalById($id_animal) {
        $stmt = $this->conn->prepare("SELECT * FROM animal WHERE id_ani = ?");
        $stmt->execute([$id_animal]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getByAnimalAndUsuario($id_animal, $id_usuario) {
        $stmt = $this->conn->prepare("
            SELECT c.*, e.nombre AS nombre_empleado
            FROM consulta c
            JOIN empleado e ON c.id_empleado = e.id_emp
            JOIN animal a ON c.id_animal = a.id_ani
            WHERE a.id_ani = ? AND a.id_usuario = ?
        ");
        $stmt->execute([$id_animal, $id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
