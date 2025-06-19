<?php
require_once 'models/empleado_model.php';

class EmpleadoController {
    public function index() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            echo "<script>alert('Acceso no autorizado'); window.location.href='index.php?modulo=login';</script>";
            exit;
        }

        $model = new EmpleadoModel();
        $empleados = $model->getAll();

        include 'views/modules/empleados.php';
    }

    public function guardar() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            echo "<script>alert('Acceso no autorizado'); window.location.href='index.php?modulo=login';</script>";
            return;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = new EmpleadoModel();
            $model->save(
                $_POST['nombre'],
                $_POST['especialidad'],
                $_POST['contratacion'],
                $_POST['id_usuario'] ?? null // Si guardás usuario aparte, o ajusta
            );
            header("Location: index.php?modulo=empleados");
        }
    }
}
