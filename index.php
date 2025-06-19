<?php
session_start();

require_once 'controllers/cliente_controller.php';
require_once 'controllers/empleado_controller.php';
require_once 'controllers/animal_controller.php';
require_once 'controllers/consulta_controller.php';

$modulo = $_GET['modulo'] ?? 'login';

switch ($modulo) {

    case 'login':
        (new ClienteController())->login();
        break;

    case 'register':
        (new ClienteController())->register();
        break;

    case 'logout':
        (new ClienteController())->logout();
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
        include 'views/modules/empleado/emplepage.php';
        break;

    case 'emp_consultas':
        include 'views/modules/empleado/admin_consultas.php';
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

    case 'clientes':
        (new ClienteController())->index();
        break;

    case 'guardar_cliente':
        (new ClienteController())->guardar();
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

    default:
        echo "<h2>Módulo no encontrado: <code>$modulo</code></h2>";
        break;
}
