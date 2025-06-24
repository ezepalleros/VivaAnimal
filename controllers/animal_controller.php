<?php
require_once 'models/animal_model.php';
require_once 'models/usuario_model.php';

class AnimalController {
    // Ver tus animales
    public function indexAnimal() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }
        $id_usuario = $_SESSION['usuario']['id_usu'];
        $model = new AnimalModel();
        $animales = $model->getAnimalByUsuario($id_usuario);
        include 'views/modules/cliente/tus_animales.php';
    }

    // Ver y gestionar todos los animales (admin)
    public function indexAdmin() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header("Location: index.php?modulo=login");
            exit;
        }
        $model = new AnimalModel();
        $mensaje = '';
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar']) && isset($_POST['id_ani'])) {
            $model->deleteAnimalAdmin($_POST['id_ani']);
            $mensaje = "Animal eliminado correctamente.";
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'])) {
            $nombre = trim($_POST['nombre']);
            $edad = intval($_POST['edad']);
            $especie = trim($_POST['especie']);
            $raza = trim($_POST['raza']);
            $id_usuario = $_POST['id_usuario'];
            if ($nombre === '') {
                $error = "El nombre no puede estar vacío.";
            } elseif ($edad <= 0 || $edad > 30) {
                $error = "La edad debe ser mayor a 0 y menor o igual a 30.";
            } else {
                $usuarioModel = new UsuarioModel();
                $usuario = $usuarioModel->getUsuarioById($id_usuario);
                if (!$usuario) {
                    $error = "El ID de usuario ingresado no existe.";
                } else {
                    $model->saveAnimal($nombre, $edad, $especie, $raza, $id_usuario);
                    $mensaje = "Animal agregado correctamente.";
                }
            }
        }
        $animales = $model->getAllAnimal();
        include 'views/modules/admin/admin_animales.php';
    }

    public function saveAdmin() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new AnimalModel();
        $model->saveAnimal(
            $_POST['nombre'],
            $_POST['edad'],
            $_POST['especie'],
            $_POST['raza'],
            $_POST['id_usuario']
        );

        header("Location: index.php?modulo=admin_animales");
    }

    public function editAdmin() {
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
                $animal = $model->getAnimalByIdAdmin($_POST['id_ani']);
                $error = "El nombre no puede estar vacío.";
                include 'views/modules/admin/editar_animal.php';
                return;
            }
            if ($edad <= 0 || $edad > 30) {
                $animal = $model->getAnimalByIdAdmin($_POST['id_ani']);
                $error = "La edad debe ser mayor a 0 y menor o igual a 30.";
                include 'views/modules/admin/editar_animal.php';
                return;
            }

            // Validar que el id_usuario existe
            $usuarioModel = new UsuarioModel();
            $usuario = $usuarioModel->getUsuarioById($id_usuario);

            if (!$usuario) {
                $animal = $model->getAnimalByIdAdmin($_POST['id_ani']);
                $error = "El ID de usuario ingresado no existe.";
                include 'views/modules/admin/editar_animal.php';
                return;
            }

            $model->updateAnimalAdmin(
                $_POST['id_ani'],
                $nombre,
                $edad,
                $_POST['especie'],
                $_POST['raza'],
                $id_usuario
            );
            header("Location: index.php?modulo=admin_animales");
        } else {
            $animal = $model->getAnimalByIdAdmin($_GET['id']);
            include 'views/modules/admin/editar_animal.php';
        }
    }

    // Eliminar desde admin
    public function deleteAnimalAdmin() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new AnimalModel();
        $model->deleteAnimalAdmin($_POST['id_ani']);

        header("Location: index.php?modulo=admin_animales");
    }


    public function saveAnimal() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new AnimalModel();
        $model->saveAnimal(
            $_POST['nombre'],
            $_POST['edad'],
            $_POST['especie'],
            $_POST['raza'],
            $_SESSION['usuario']['id_usu']
        );

        header("Location: index.php?modulo=tus_animales");
    }

    public function deleteAnimal() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new AnimalModel();
        $model->deleteAnimal($_GET['id'], $_SESSION['usuario']['id_usu']);

        header("Location: index.php?modulo=tus_animales");
    }

    public function editAnimal() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new AnimalModel();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model->updateAnimal(
                $_POST['id_ani'],
                $_POST['nombre'],
                $_POST['edad'],
                $_POST['especie'],
                $_POST['raza'],
                $_SESSION['usuario']['id_usu']
            );
            header("Location: index.php?modulo=tus_animales");
        } else {
            $animal = $model->getAnimalById($_GET['id'], $_SESSION['usuario']['id_usu']);
            $animales = $model->getAnimalByUsuario($_SESSION['usuario']['id_usu']);

            include 'views/modules/cliente/tus_animales.php';
        }
    }
}