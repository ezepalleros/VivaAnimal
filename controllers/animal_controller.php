<?php
require_once 'models/animal_model.php';

class AnimalController {
    public function index() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $id_usuario = $_SESSION['usuario']['id_usu'];
        $model = new AnimalModel();
        $animales = $model->getByUsuario($id_usuario);

        include 'views/modules/cliente/tus_animales.php';
    }

    // Vista para admin_animales
public function indexAdmin() {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
        header("Location: index.php?modulo=login");
        exit;
    }

    $model = new AnimalModel();
    $mensaje = '';
    $error = '';

    // Eliminar animal si viene el POST de eliminar
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar']) && isset($_POST['id_ani'])) {
        $model->deleteAdmin($_POST['id_ani']);
        $mensaje = "Animal eliminado correctamente.";
    }
    // Agregar animal si viene el POST de agregar
    else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
        $nombre = trim($_POST['nombre']);
        $edad = intval($_POST['edad']);
        $especie = trim($_POST['especie']);
        $raza = trim($_POST['raza']);
        $id_usuario = $_POST['id_usuario'];

        // Validaciones básicas
        if ($nombre === '') {
            $error = "El nombre no puede estar vacío.";
        } elseif ($edad <= 0 || $edad > 30) {
            $error = "La edad debe ser mayor a 0 y menor o igual a 30.";
        } else {
            // Validar que el usuario existe
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getById($id_usuario);
            if (!$usuario) {
                $error = "El ID de usuario ingresado no existe.";
            } else {
                $model->save($nombre, $edad, $especie, $raza, $id_usuario);
                $mensaje = "Animal agregado correctamente.";
            }
        }
    }

    $animales = $model->getAll();
    include 'views/modules/admin/admin_animales.php';
}

// Guardar desde admin
public function guardarAdmin() {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
        header("Location: index.php?modulo=login");
        exit;
    }

    $model = new AnimalModel();
    $model->save(
        $_POST['nombre'],
        $_POST['edad'],
        $_POST['especie'],
        $_POST['raza'],
        $_POST['id_usuario']
    );

    header("Location: index.php?modulo=admin_animales");
}

// Editar desde admin
public function editarAdmin() {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
        header("Location: index.php?modulo=login");
        exit;
    }

    $model = new AnimalModel();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = trim($_POST['nombre']);
        $edad = intval($_POST['edad']);
        $id_usuario = $_POST['id_usuario'];

        // Validaciones
        if ($nombre === '') {
            $animal = $model->getByIdAdmin($_POST['id_ani']);
            $error = "El nombre no puede estar vacío.";
            include 'views/modules/admin/editar_animal.php';
            return;
        }
        if ($edad <= 0 || $edad > 30) {
            $animal = $model->getByIdAdmin($_POST['id_ani']);
            $error = "La edad debe ser mayor a 0 y menor o igual a 30.";
            include 'views/modules/admin/editar_animal.php';
            return;
        }

        // Validar que el id_usuario existe
        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->getById($id_usuario);

        if (!$usuario) {
            $animal = $model->getByIdAdmin($_POST['id_ani']);
            $error = "El ID de usuario ingresado no existe.";
            include 'views/modules/admin/editar_animal.php';
            return;
        }

        $model->updateAdmin(
            $_POST['id_ani'],
            $nombre,
            $edad,
            $_POST['especie'],
            $_POST['raza'],
            $id_usuario
        );
        header("Location: index.php?modulo=admin_animales");
    } else {
        $animal = $model->getByIdAdmin($_GET['id']);
        include 'views/modules/admin/editar_animal.php';
    }
}

// Eliminar desde admin
public function eliminarAdmin() {
    if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
        header("Location: index.php?modulo=login");
        exit;
    }

    $model = new AnimalModel();
    $model->deleteAdmin($_POST['id_ani']);

    header("Location: index.php?modulo=admin_animales");
}


    public function guardar() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new AnimalModel();
        $model->save(
            $_POST['nombre'],
            $_POST['edad'],
            $_POST['especie'],
            $_POST['raza'],
            $_SESSION['usuario']['id_usu']
        );

        header("Location: index.php?modulo=tus_animales");
    }

    public function eliminar() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new AnimalModel();
        $model->delete($_GET['id'], $_SESSION['usuario']['id_usu']);

        header("Location: index.php?modulo=tus_animales");
    }

    public function editar() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new AnimalModel();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model->update(
                $_POST['id_ani'],
                $_POST['nombre'],
                $_POST['edad'],
                $_POST['especie'],
                $_POST['raza'],
                $_SESSION['usuario']['id_usu']
            );
            header("Location: index.php?modulo=tus_animales");
        } else {
            $animal = $model->getById($_GET['id'], $_SESSION['usuario']['id_usu']);
            $animales = $model->getByUsuario($_SESSION['usuario']['id_usu']);

            include 'views/modules/cliente/tus_animales.php';
        }
    }
}