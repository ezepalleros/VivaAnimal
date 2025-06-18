<?php
require_once 'models/cliente_model.php';

class ClienteController {
    public function index() {
        $model = new ClienteModel();
        $clientes = $model->getAll();
        include 'views/modules/clientes.php';
    }

    public function guardar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = new ClienteModel();
            $model->save($_POST['nombre'], $_POST['email'], $_POST['telefono'], $_POST['direccion'], 'cliente');
            header("Location: index.php?modulo=clientes");
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = new ClienteModel();
            $cliente = $model->login($_POST['email'], $_POST['telefono']);

            if ($cliente) {
                session_start();
                $_SESSION['cliente'] = $cliente;

                switch ($cliente['rol']) {
                    case 'cliente':
                        header("Location: index.php?modulo=homepage");
                        break;
                    case 'empleado':
                        header("Location: index.php?modulo=emplepage");
                        break;
                    case 'admin':
                        header("Location: index.php?modulo=adminpage");
                        break;
                }
            } else {
                echo "<script>alert('Credenciales incorrectas'); window.location.href='index.php?modulo=login';</script>";
            }
        } else {
            include 'views/modules/auth/login.php';
        }
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = new ClienteModel();
            $model->save($_POST['nombre'], $_POST['email'], $_POST['telefono'], $_POST['direccion'], 'cliente');
            echo "<script>alert('Registro exitoso. Ahora podés iniciar sesión.'); window.location.href='index.php?modulo=login';</script>";
        } else {
            include 'views/modules/auth/register.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?modulo=login");
    }
}
