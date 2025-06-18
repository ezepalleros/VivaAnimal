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
        include 'views/modules/cliente/tus_animales.php';
        break;

    case 'ver_consultas':
        include 'views/modules/cliente/ver_consultas.php';
        break;

    case 'hacer_consulta':
        include 'views/modules/cliente/hacer_consulta.php';
        break;

    case 'emplepage':
        include 'views/modules/empleado/emplepage.php';
        break;

    case 'admin_consultas':
        include 'views/modules/empleado/admin_consultas.php';
        break;

    case 'ver_consultas_emp':
        include 'views/modules/empleado/ver_consultas_emp.php';
        break;

    case 'adminpage':
        include 'views/modules/admin/adminpage.php';
        break;

    case 'ver_usuarios':
        include 'views/modules/admin/ver_usuarios.php';
        break;

    case 'ver_empleados':
        include 'views/modules/admin/ver_empleados.php';
        break;

    case 'ver_animales':
        include 'views/modules/admin/ver_animales.php';
        break;

    case 'ver_consultas_admin':
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

    case 'guardar_animal':
        (new AnimalController())->guardar();
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
