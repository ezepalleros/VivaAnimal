<?php
require_once 'models/usuario_model.php';

class UsuarioController {
    public function index() {
        $model = new UsuarioModel();
        $usuarios = $model->getAll();
        include 'views/modules/usuarios.php';
    }

    public function guardar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = new UsuarioModel();
            $model->save($_POST['nombre'], $_POST['email'], $_POST['telefono'], $_POST['direccion'], 'cliente');
            header("Location: index.php?modulo=usuarios");
        }
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = new UsuarioModel();
            $usuario = $model->login($_POST['email'], $_POST['telefono']);

            if ($usuario) {
                $_SESSION['usuario'] = $usuario;

                switch ($usuario['rol']) {
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
            $model = new UsuarioModel();
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

    public function editar() {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
        header("Location: index.php?modulo=login");
        exit;
    }

    $model = new UsuarioModel();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $model->update(
            $_POST['id_usu'],
            $_POST['nombre'],
            $_POST['email'],
            $_POST['telefono'],
            $_POST['direccion'],
            $_POST['rol']
        );
        header("Location: index.php?modulo=admin_usuarios");
    } else {
        $usuario = $model->getById($_GET['id']);
        include 'views/modules/admin/editar_usuario.php';
    }
}
    
    public function eliminar() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_usu'])) {
            $model = new UsuarioModel();
            $model->eliminar($_POST['id_usu']);
            header("Location: index.php?modulo=admin_usuarios");
        }
    }
}
