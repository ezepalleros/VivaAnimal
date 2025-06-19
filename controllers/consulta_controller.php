<?php
require_once 'models/consulta_model.php';

class ConsultaController {
    public function index() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $model = new ConsultaModel();
        $animales = $model->getAnimalesPorUsuario($_SESSION['usuario']['id_usu']);
        $empleados = $model->getEmpleados();

        include 'views/modules/cliente/hacer_consulta.php';
    }

    public function guardar() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = new ConsultaModel();

            $fecha_ingresada = $_POST['fecha'];
            if ($fecha_ingresada <= date('Y-m-d')) {
                echo "<script>alert('La fecha debe ser posterior a hoy.'); window.location.href='index.php?modulo=hacer_consulta';</script>";
                exit;
            }

            $model->save(
                $fecha_ingresada,
                $_POST['descripcion'],
                $_POST['id_animal'],
                $_POST['id_empleado'],
                false
            );

            echo "<script>alert('Consulta registrada correctamente.'); window.location.href='index.php?modulo=tus_animales';</script>";
        }
    }

    public function getByAnimal() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
            header("Location: index.php?modulo=login");
            exit;
        }

        $id_animal = $_GET['id'] ?? null;

        if (!$id_animal) {
            echo "ID de animal no especificado";
            exit;
        }

        $model = new ConsultaModel();
        $consultas = $model->getByAnimal($id_animal);
        $animal = $model->getAnimalById($id_animal);

        include 'views/modules/cliente/tus_consultas.php';
    }
}

