<?php
require_once 'models/empleado_model.php';

class EmpleadoController {
    public function index() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
            header("Location: index.php?modulo=login");
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

    public function verPanel() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'empleado') {
            header("Location: index.php?modulo=login");
            exit;
        }
    
        $id_usuario = $_SESSION['usuario']['id_usu'];
    
        $modelEmp = new EmpleadoModel();
        $empleado = $modelEmp->getByUsuarioId($id_usuario);
    
        if (!$empleado) {
            echo "<p>Error: No se encontró el empleado.</p>";
            exit;
        }
    
        $id_emp = $empleado['id_emp'];
    
        $modelCon = new ConsultaModel();
        $pendientes = $modelCon->getConsultasPorEmpleado($id_emp, 0);
        $atendidas = $modelCon->getConsultasPorEmpleado($id_emp, 1);
    
        include 'views/modules/empleado/emplepage.php';
    }
    
    public function aceptarConsulta() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_con'])) {
            $model = new ConsultaModel();
            $model->marcarComoAtendida($_POST['id_con']);
            header("Location: index.php?modulo=emplepage");
        }
    }

    public function getByEmpleado() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'empleado') {
            header("Location: index.php?modulo=login");
            exit;
        }
    
        $id_usuario = $_SESSION['usuario']['id_usu'];
    
        require_once 'models/empleado_model.php';
        $empModel = new EmpleadoModel();
        $empleado = $empModel->getByUsuario($id_usuario);
    
        if (!$empleado) {
            echo "Empleado no encontrado.";
            exit;
        }
    
        $id_empleado = $empleado['id_emp'];
    
        $model = new ConsultaModel();
        $consultasPendientes = $model->getByEmpleadoAndEstado($id_empleado, false);
        $consultasAtendidas = $model->getByEmpleadoAndEstado($id_empleado, true);
    
        include 'views/modules/empleado/emp_consultas.php';
    }

    public function editarEspecialidad() {
        if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'empleado') {
            header("Location: index.php?modulo=login");
            exit;
        }
    
        require_once 'models/empleado_model.php';
        $empModel = new EmpleadoModel();
        $empleado = $empModel->getByUsuario($_SESSION['usuario']['id_usu']);
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nueva = $_POST['especialidad'];
            $empModel->actualizarEspecialidad($empleado['id_emp'], $nueva);
            echo "<script>alert('Especialidad actualizada'); window.location.href='index.php?modulo=emp_especialidad';</script>";
        } else {
            include 'views/modules/empleado/emp_especialidad.php';
        }
    }
    
    
}
