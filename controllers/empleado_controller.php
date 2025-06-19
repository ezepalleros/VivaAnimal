<?php
require_once 'models/empleado_model.php';

class EmpleadoController {
    public function index() {
        if (!isset($_SESSION['cliente']) || $_SESSION['cliente']['rol'] !== 'admin') {
            echo "<script>alert('Acceso no autorizado'); window.location.href='index.php?modulo=login';</script>";
            exit;
        }

        $model = new EmpleadoModel();
        $empleados = $model->getAll();

        include 'views/modules/empleados.php';
    }

    public function guardar() {
        if (!isset($_SESSION['cliente']) || $_SESSION['cliente']['rol'] !== 'empleado') {
            echo "<script>alert('Acceso no autorizado'); window.location.href='index.php?modulo=login';</script>";
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = new EmpleadoModel();
            $model->save(
                $_POST['nombre'],
                $_POST['especialidad'],
                $_POST['contratacion'],
                $_SESSION['cliente']['id_cli']
            );
            header("Location: index.php?modulo=empleados");
        }
    }
}
