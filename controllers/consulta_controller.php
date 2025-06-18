<?php
require_once 'models/consulta_model.php';

class ConsultaController {
    public function index() {
        session_start();

        $model = new ConsultaModel();
        $consultas = $model->getAll();
        $animales = $model->getAnimales();
        $empleados = $model->getEmpleados();

        include 'views/modules/consultas.php';
    }

    public function guardar() {
        session_start();

        if (!isset($_SESSION['cliente'])) {
            header("Location: index.php?modulo=login");
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $model = new ConsultaModel();
            $model->save(
                $_POST['fecha'],
                $_POST['descripcion'],
                $_POST['id_animal'],
                $_POST['id_empleado']
            );
            header("Location: index.php?modulo=consultas");
        }
    }
}
