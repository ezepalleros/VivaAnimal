<?php
// Iniciar sesión para toda la app
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Mostrar errores en desarrollo
ini_set('display_errors', 1);
ini_set('log_errors', 1);

// Dependencias
require_once 'models/connection.php';
require_once 'models/routes.php';

// Controladores
require_once 'controllers/template_controller.php';
require_once 'controllers/usuario_controller.php';
require_once 'controllers/empleado_controller.php';
require_once 'controllers/animal_controller.php';
require_once 'controllers/consulta_controller.php';

// Header, módulo y footer
$template = new TemplateController();
$template->getTemplate();
