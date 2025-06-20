<?php
require_once 'connection.php';

class AnimalModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }
    
    public function getByUsuario($id_usuario) {
        $stmt = $this->conn->prepare("SELECT * FROM animal WHERE id_usuario = ?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAll() {
        $stmt = $this->conn->query("
            SELECT a.*, u.nombre AS nombre_dueño
            FROM animal a
            JOIN usuario u ON a.id_usuario = u.id_usu
        ");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getByIdAdmin($id_ani) {
        $stmt = $this->conn->prepare("SELECT * FROM animal WHERE id_ani = ?");
        $stmt->execute([$id_ani]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function deleteAdmin($id_ani) {
        $stmt = $this->conn->prepare("DELETE FROM animal WHERE id_ani = ?");
        return $stmt->execute([$id_ani]);
    }

// Actualizar sin validar dueño
    public function updateAdmin($id_ani, $nombre, $edad, $especie, $raza, $id_usuario) {
        $stmt = $this->conn->prepare("
            UPDATE animal 
            SET nombre = ?, edad = ?, especie = ?, raza = ?, id_usuario = ? 
            WHERE id_ani = ?
        ");
        return $stmt->execute([$nombre, $edad, $especie, $raza, $id_usuario, $id_ani]);
    }

    // Agregar nuevo animal
    public function save($nombre, $edad, $especie, $raza, $id_usuario) {
        $stmt = $this->conn->prepare("INSERT INTO animal (nombre, edad, especie, raza, id_usuario) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $edad, $especie, $raza, $id_usuario]);
    }

    // Eliminar animal
    public function delete($id_ani, $id_usuario) {
        $stmt = $this->conn->prepare("DELETE FROM animal WHERE id_ani = ? AND id_usuario = ?");
        return $stmt->execute([$id_ani, $id_usuario]);
    }

    // Obtener uno para editar
    public function getById($id_ani, $id_usuario) {
        $stmt = $this->conn->prepare("SELECT * FROM animal WHERE id_ani = ? AND id_usuario = ?");
        $stmt->execute([$id_ani, $id_usuario]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Modificar animal
    public function update($id_ani, $nombre, $edad, $especie, $raza, $id_usuario) {
        $stmt = $this->conn->prepare("UPDATE animal SET nombre=?, edad=?, especie=?, raza=? WHERE id_ani=? AND id_usuario=?");
        return $stmt->execute([$nombre, $edad, $especie, $raza, $id_ani, $id_usuario]);
    }
}
