<?php
session_start();

require_once 'controllers/usuario_controller.php';
require_once 'controllers/empleado_controller.php';
require_once 'controllers/animal_controller.php';
require_once 'controllers/consulta_controller.php';

$modulo = $_GET['modulo'] ?? 'login';

switch ($modulo) {
    case 'login':
        (new UsuarioController())->login();
        break;

    case 'register':
        (new UsuarioController())->register();
        break;

    case 'logout':
        (new UsuarioController())->logout();
        break;

    case 'homepage':
        include 'views/modules/cliente/homepage.php';
        break;

    case 'tus_animales':
        (new AnimalController())->index();
        break;

    case 'guardar_animal':
        (new AnimalController())->guardar();
        break;

    case 'editar_animal':
        (new AnimalController())->editar();
        break;

    case 'eliminar_animal':
        (new AnimalController())->eliminar();
        break;

    case 'tus_consultas':
        (new ConsultaController())->getByAnimal();
        break;

    case 'hacer_consulta':
        (new ConsultaController())->index();
        break;

    case 'emplepage':
        (new EmpleadoController())->verPanel();
        break;

    case 'emp_consultas':
        (new ConsultaController())->getByEmpleado();
        break;

    case 'emp_especialidad':
        (new EmpleadoController())->editarEspecialidad();
        break;

    case 'adminpage':
        include 'views/modules/admin/adminpage.php';
        break;

    case 'admin_usuarios':
        include 'views/modules/admin/ver_usuarios.php';
        break;

    case 'admin_empleados':
        include 'views/modules/admin/ver_empleados.php';
        break;

    case 'admin_animales':
        include 'views/modules/admin/ver_animales.php';
        break;

    case 'admin_consultas_admin':
        include 'views/modules/admin/ver_consultas.php';
        break;

    case 'usuarios':
        (new UsuarioController())->index();
        break;

    case 'guardar_usuario':
        (new UsuarioController())->guardar();
        break;

    case 'empleados':
        (new EmpleadoController())->index();
        break;

    case 'guardar_empleado':
        (new EmpleadoController())->guardar();
        break;

    case 'animales':
        (new AnimalController())->index();
        break;

    case 'consultas':
        (new ConsultaController())->index();
        break;

    case 'guardar_consulta':
        (new ConsultaController())->guardar();
        break;

    case 'aceptar_consulta':
        (new EmpleadoController())->aceptarConsulta();
        break;

    default:
        echo "<h2>Módulo no encontrado: <code>$modulo</code></h2>";
        break;
}

