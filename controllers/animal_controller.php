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
