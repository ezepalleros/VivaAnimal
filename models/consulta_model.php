<?php
require_once 'models/connection.php';

class ConsultaModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("
            SELECT 
                c.id_con,
                c.fecha,
                c.descripcion,
                c.estado,
                a.nombre AS nombre_animal,
                u_dueño.nombre AS nombre_dueño,
                u_vet.nombre AS nombre_empleado
            FROM consulta c
            JOIN animal a ON c.id_animal = a.id_ani
            JOIN usuario u_dueño ON a.id_usuario = u_dueño.id_usu
            JOIN empleado e ON c.id_empleado = e.id_emp
            JOIN usuario u_vet ON e.id_usuario = u_vet.id_usu
            ORDER BY c.fecha DESC
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

    public function getConsultasPorEmpleado($id_emp, $estado) {
        $stmt = $this->conn->prepare("
            SELECT c.id_con, c.fecha, c.descripcion, c.estado,
                   a.nombre AS nombre_animal, a.especie
            FROM consulta c
            JOIN animal a ON c.id_animal = a.id_ani
            WHERE c.id_empleado = ? AND c.estado = ?
            ORDER BY c.fecha ASC
        ");
        $stmt->execute([$id_emp, (int)$estado]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function marcarComoAtendida($id_con) {
        $stmt = $this->conn->prepare("UPDATE consulta SET estado = TRUE WHERE id_con = ?");
        return $stmt->execute([$id_con]);
    }

    public function getByEmpleadoAndEstado($id_empleado, $estado) {
        $stmt = $this->conn->prepare("SELECT c.*, a.nombre AS nombre_animal 
                                       FROM consulta c 
                                       JOIN animal a ON c.id_animal = a.id_ani 
                                       WHERE c.id_empleado = ? AND c.estado = ?");
        $stmt->execute([$id_empleado, $estado]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getEmpleadoIdByUsuario($id_usuario) {
        $stmt = $this->conn->prepare("SELECT id_emp FROM empleado WHERE id_usuario = ?");
        $stmt->execute([$id_usuario]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['id_emp'] ?? null;
    }
    
    public function getAllAnimalesConDueño() {
        $stmt = $this->conn->query("
            SELECT a.id_ani, a.nombre, u.nombre AS nombre_dueño
            FROM animal a
            JOIN usuario u ON a.id_usuario = u.id_usu
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id_con) {
        $stmt = $this->conn->prepare("SELECT * FROM consulta WHERE id_con = ?");
        $stmt->execute([$id_con]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id_con, $fecha, $descripcion, $id_animal, $id_empleado, $estado) {
        $stmt = $this->conn->prepare("
            UPDATE consulta SET fecha=?, descripcion=?, id_animal=?, id_empleado=?, estado=?
            WHERE id_con=?
        ");
        return $stmt->execute([$fecha, $descripcion, $id_animal, $id_empleado, $estado, $id_con]);
    }
    
    public function eliminar($id_con) {
        $stmt = $this->conn->prepare("DELETE FROM consulta WHERE id_con = ?");
        return $stmt->execute([$id_con]);
    }
}
