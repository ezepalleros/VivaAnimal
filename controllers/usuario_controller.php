<?php
require_once 'models/usuario_model.php';

class UsuarioController {
    public function indexUsuario() {
        $model = new UsuarioModel();
        $usuarios = $model->getAllUsuario();
        include 'views/modules/usuarios.php';
    }

    public function saveUsuario() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = new UsuarioModel();
            $model->saveUsuario($_POST['nombre'], $_POST['email'], $_POST['telefono'], $_POST['direccion'], 'cliente');
            header("Location: index.php?modulo=usuarios");
        }
    }

    public function login() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = new UsuarioModel();
            $usuario = $model->login($_POST['email'], $_POST['telefono']);

            if ($usuario) {
                $_SESSION['usuario'] = $usuario;
                switch ($usuario['rol']) {
                    case 'cliente':
                        header("Location: index.php?modulo=homepage");
                        exit;
                    case 'empleado':
                        header("Location: index.php?modulo=emplepage");
                        exit;
                    case 'admin':
                        header("Location: index.php?modulo=adminpage");
                        exit;
                }
            } else {
                echo "<script>alert('Credenciales incorrectas'); window.location.href='index.php?modulo=login';</script>";
                exit;
            }
        } else {
            include 'views/modules/auth/login.php';
        }
    }

    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];

            $model = new UsuarioModel();

            // Validar si el email ya existe
            if ($model->getUsuarioByEmail($email)) {
                echo "<script>alert('El email ya está registrado. Por favor, usa otro.'); window.history.back();</script>";
                exit;
            }

            $model->saveUsuario($nombre, $email, $telefono, $direccion, 'cliente');
            header("Location: index.php?modulo=login");
            exit;
        } else {
            include 'views/modules/auth/register.php';
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?modulo=login");
    }

    public function editUsuarioAdmin() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new UsuarioModel();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $model->updateUsuario(
                $_POST['id_usu'],
                $_POST['nombre'],
                $_POST['email'],
                $_POST['telefono'],
                $_POST['direccion'],
                $_POST['rol']
            );
            header("Location: index.php?modulo=admin_usuarios");
        } else {
            $usuario = $model->getUsuarioById($_GET['id']);
            include 'views/modules/admin/editar_usuario.php';
        }
    }
    
    public function deleteUsuarioAdmin() {
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_usu'])) {
            $model = new UsuarioModel();
            $model->deleteUsuario($_POST['id_usu']);
            header("Location: index.php?modulo=admin_usuarios");
        }
    }

    public function addUsuarioAdmin() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $email = $_POST['email'];
            $telefono = $_POST['telefono'];
            $direccion = $_POST['direccion'];
            $rol = $_POST['rol'];

            $model = new UsuarioModel();

            // Validar si el email ya existe
            if ($model->getUsuarioByEmail($email)) {
                echo "<script>alert('El email ya está registrado. Por favor, usa otro.'); window.history.back();</script>";
                exit;
            }

            $model->saveUsuario($nombre, $email, $telefono, $direccion, $rol);

            // Obtener el id del usuario recién creado
            $id_usuario = $model->getUsuarioByEmail($email)['id_usu'];

            // Si es empleado, insertar en la tabla empleado
            if ($rol === 'empleado') {
                require_once 'models/empleado_model.php';
                $especialidad = $_POST['especialidad'];
                $contratacion = $_POST['contratacion'];
                $empModel = new EmpleadoModel();
                $empModel->saveEmpleado($especialidad, $contratacion, $id_usuario);
            }

            header("Location: index.php?modulo=admin_usuarios");
            exit;
        }
    }
}
