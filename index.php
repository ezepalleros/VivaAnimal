<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

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

    // Empleado
    case 'emplepage':
        (new EmpleadoController())->verPanel();
        break;

    case 'emp_consultas':
        (new ConsultaController())->getByEmpleado();
        break;

    case 'emp_especialidad':
        (new EmpleadoController())->editarEspecialidad();
        break;

    case 'aceptar_consulta':
        (new EmpleadoController())->aceptarConsulta();
        break;

    case 'adminpage':
        include 'views/modules/admin/adminpage.php';
        break;

    case 'admin_usuarios':
        include 'views/modules/admin/admin_usuarios.php';
        break;

    case 'admin_consultas':
        (new ConsultaController())->indexAdmin();
        break;

    // Admin - CRUD controladores
    case 'usuarios':
        (new UsuarioController())->index();
        break;

    case 'guardar_usuario':
        (new UsuarioController())->guardar();
        break;

    case 'editar_usuario':
        (new UsuarioController())->editar();
        break;
  
    case 'eliminar_usuario':
        (new UsuarioController())->eliminar();
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

    case 'admin_animales':
        (new AnimalController())->indexAdmin();
        break;

    case 'editar_animal_admin':
        (new AnimalController())->editarAdmin();
        break;

    case 'eliminar_animal_admin':
        (new AnimalController())->eliminarAdmin();
        break;
    
    case 'editar_consulta_admin':
        (new ConsultaController())->editarAdmin();
        break;

    case 'eliminar_consulta_admin':
        (new ConsultaController())->eliminarAdmin();
        break;

    default:
        echo "<h2>Módulo no encontrado: <code>$modulo</code></h2>";
        break;
}