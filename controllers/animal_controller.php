<?php
require_once 'models/animal_model.php';

class AnimalController {
    public function index() {
        if (!isset($_SESSION['cliente']) || $_SESSION['cliente']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $id_cliente = $_SESSION['cliente']['id_cli'];
        $model = new AnimalModel();
        $animales = $model->getByCliente($id_cliente);

        include 'views/modules/cliente/tus_animales.php';

    }

    public function guardar() {
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
        if (!isset($_SESSION['cliente']) || $_SESSION['cliente']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new AnimalModel();
        $model->delete($_GET['id'], $_SESSION['cliente']['id_cli']);

        header("Location: index.php?modulo=animales");
    }

    public function editar() {
    if (!isset($_SESSION['cliente']) || $_SESSION['cliente']['rol'] !== 'cliente') {
        header("Location: index.php?modulo=login");
        exit;
    }

    $model = new AnimalModel();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Guardar cambios
        $model->update(
            $_POST['id_ani'],
            $_POST['nombre'],
            $_POST['edad'],
            $_POST['especie'],
            $_POST['raza'],
            $_SESSION['cliente']['id_cli']
        );
        header("Location: index.php?modulo=tus_animales");
    } else {
        // Mostrar formulario con datos
        $animal = $model->getById($_GET['id'], $_SESSION['cliente']['id_cli']);
        $animales = $model->getByCliente($_SESSION['cliente']['id_cli']); // 👈 Esto se usa en la vista

        include 'views/modules/cliente/tus_animales.php';
    }
}


}
