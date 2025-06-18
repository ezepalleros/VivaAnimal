<?php
require_once 'models/animal_model.php';

class AnimalController {
    public function index() {
        session_start();

        if (!isset($_SESSION['cliente']) || $_SESSION['cliente']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $id_cliente = $_SESSION['cliente']['id_cli'];
        $model = new AnimalModel();
        $animales = $model->getByCliente($id_cliente);

        include 'views/modules/animales.php';
    }

    public function guardar() {
        session_start();

        if (!isset($_SESSION['cliente']) || $_SESSION['cliente']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new AnimalModel();
        $model->save(
            $_POST['nombre'],
            $_POST['edad'],
            $_POST['especie'],
            $_POST['raza'],
            $_SESSION['cliente']['id_cli']
        );

        header("Location: index.php?modulo=animales");
    }

    public function eliminar() {
        session_start();

        if (!isset($_SESSION['cliente']) || $_SESSION['cliente']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new AnimalModel();
        $model->delete($_GET['id'], $_SESSION['cliente']['id_cli']);

        header("Location: index.php?modulo=animales");
    }

    public function editar() {
        session_start();

        if (!isset($_SESSION['cliente']) || $_SESSION['cliente']['rol'] !== 'cliente') {
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
                $_SESSION['cliente']['id_cli']
            );
            header("Location: index.php?modulo=animales");
        } else {
            $animal = $model->getById($_GET['id'], $_SESSION['cliente']['id_cli']);
            include 'views/modules/animales.php';
        }
    }
}
