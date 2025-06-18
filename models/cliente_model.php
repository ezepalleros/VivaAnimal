<?php
require_once 'connection.php';

class ClienteModel {
    private $conn;

    public function __construct() {
        $this->conn = Database::getInstance()->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->query("SELECT * FROM clientes");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function save($nombre, $email, $telefono, $direccion, $rol = 'cliente') {
        $stmt = $this->conn->prepare("INSERT INTO clientes (nombre, email, telefono, direccion, rol) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$nombre, $email, $telefono, $direccion, $rol]);
}

    public function login($email, $telefono) {
        $stmt = $this->conn->prepare("SELECT * FROM clientes WHERE email = ? AND telefono = ?");
        $stmt->execute([$email, $telefono]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
}

}
