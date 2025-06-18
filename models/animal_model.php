<?php
require_once 'connection.php';

class AnimalModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    // Obtener animales del cliente actual
    public function getByCliente($id_cliente) {
        $stmt = $this->conn->prepare("SELECT * FROM animales WHERE id_cliente = ?");
        $stmt->execute([$id_cliente]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Agregar nuevo animal
    public function save($nombre, $edad, $especie, $raza, $id_cliente) {
        $stmt = $this->conn->prepare("INSERT INTO animales (nombre, edad, especie, raza, id_cliente) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $edad, $especie, $raza, $id_cliente]);
    }

    // Eliminar animal
    public function delete($id_ani, $id_cliente) {
        $stmt = $this->conn->prepare("DELETE FROM animales WHERE id_ani = ? AND id_cliente = ?");
        return $stmt->execute([$id_ani, $id_cliente]);
    }

    // Obtener uno para editar
    public function getById($id_ani, $id_cliente) {
        $stmt = $this->conn->prepare("SELECT * FROM animales WHERE id_ani = ? AND id_cliente = ?");
        $stmt->execute([$id_ani, $id_cliente]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Modificar animal
    public function update($id_ani, $nombre, $edad, $especie, $raza, $id_cliente) {
        $stmt = $this->conn->prepare("UPDATE animales SET nombre=?, edad=?, especie=?, raza=? WHERE id_ani=? AND id_cliente=?");
        return $stmt->execute([$nombre, $edad, $especie, $raza, $id_ani, $id_cliente]);
    }
}
