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

    public function getByEmpleado() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'empleado') {
            header("Location: index.php?modulo=login");
            exit;
        }
    
        $model = new ConsultaModel();
        $id_empleado = $model->getEmpleadoIdByUsuario($_SESSION['usuario']['id_usu']);
    
        $consultasPendientes = $model->getConsultasPorEmpleado($id_empleado, 0);
        $consultasAtendidas = $model->getConsultasPorEmpleado($id_empleado, 1);
    
        include 'views/modules/empleado/emp_consultas.php';
    }
    
    public function indexAdmin() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header("Location: index.php?modulo=login");
            exit;
        }
        $model = new ConsultaModel();
        $mensaje = '';
        $error = '';

        // Para selects del formulario
        $animales = $model->getAllAnimalesConDueño();
        $empleados = $model->getEmpleados();

        // Agregar consulta
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['agregar_consulta'])) {
            $fecha = $_POST['fecha'];
            $descripcion = trim($_POST['descripcion']);
            $id_animal = $_POST['id_animal'];
            $id_empleado = $_POST['id_empleado'];

            // Validaciones
            if ($fecha <= date('Y-m-d')) {
                $error = "La fecha debe ser posterior a hoy.";
            } elseif ($descripcion === '') {
                $error = "La descripción no puede estar vacía.";
            } else {
                $ok = $model->save($fecha, $descripcion, $id_animal, $id_empleado, false);
                if ($ok) {
                    $mensaje = "Consulta agregada correctamente.";
                } else {
                    $error = "Error al agregar la consulta.";
                }
            }
        }

        $consultas = $model->getAll();
        include 'views/modules/admin/admin_consultas.php';
    }

    public function editarAdmin() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header("Location: index.php?modulo=login");
            exit;
        }
        $model = new ConsultaModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Validaciones aquí...
            $model->update(
                $_POST['id_con'],
                $_POST['fecha'],
                $_POST['descripcion'],
                $_POST['id_animal'],
                $_POST['id_empleado'],
                $_POST['estado']
            );
            header("Location: index.php?modulo=admin_consultas");
        } else {
            $consulta = $model->getById($_GET['id']);
            $animales = $model->getAllAnimalesConDueño();
            $empleados = $model->getEmpleados();
            include 'views/modules/admin/editar_consulta.php';
        }
    }

    public function eliminarAdmin() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header("Location: index.php?modulo=login");
            exit;
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_con'])) {
            $model = new ConsultaModel();
            $model->eliminar($_POST['id_con']);
        }
        header("Location: index.php?modulo=admin_consultas");
    }
}

