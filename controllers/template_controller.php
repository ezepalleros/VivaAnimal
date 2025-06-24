<?php
class TemplateController {
    public function getTemplate() {
        require_once "componentes/header.php";

        $modulo = $_GET['modulo'] ?? 'login';
        $rutaModulo = $this->getModuloPath($modulo);

        if ($rutaModulo && file_exists($rutaModulo)) {
            include $rutaModulo;
        } elseif ($rutaModulo === null) {
            // Ya fue manejado por el controlador
        } else {
            echo "<h2>Módulo no encontrado: <code>$modulo</code></h2>";
        }

        require_once "componentes/footer.php";
    }

    private function getModuloPath($modulo) {
        switch ($modulo) {
            // Usuario
            case 'login':
                (new UsuarioController())->login();
                return null;
            case 'register':
                (new UsuarioController())->register();
                return null;
            case 'logout':
                (new UsuarioController())->logout();
                return null;
            case 'homepage':
                return "views/modules/cliente/homepage.php";

            // Cliente
            case 'tus_animales':
                (new AnimalController())->indexAnimal();
                return null;
            case 'guardar_animal':
                (new AnimalController())->saveAnimal();
                return null;
            case 'editar_animal':
                (new AnimalController())->editAnimal();
                return null;
            case 'eliminar_animal':
                (new AnimalController())->deleteAnimal();
                return null;
            case 'tus_consultas':
                (new ConsultaController())->getByAnimal();
                return null;
            case 'hacer_consulta':
                (new ConsultaController())->indexConsulta();
                return null;
            case 'guardar_consulta':
                (new ConsultaController())->saveConsulta();
                return null;

            // Empleado
            case 'emplepage':
                (new EmpleadoController())->verPanelEmpleado();
                return null;
            case 'emp_consultas':
                (new EmpleadoController())->getByEmpleado();
                return null;
            case 'emp_especialidad':
                (new EmpleadoController())->editEspecialidad();
                return null;
            case 'aceptar_consulta':
                (new EmpleadoController())->checkConsultaEmpleado();
                return null;

            // Admin
            case 'adminpage':
                return "views/modules/admin/adminpage.php";
            case 'admin_usuarios':
                return "views/modules/admin/admin_usuarios.php";
            case 'admin_consultas':
                (new ConsultaController())->indexAdmin();
                return null;
            case 'usuarios':
                (new UsuarioController())->indexUsuario();
                return null;
            case 'guardar_usuario':
                (new UsuarioController())->saveUsuario();
                return null;
            case 'editar_usuario':
                (new UsuarioController())->editUsuarioAdmin();
                return null;
            case 'eliminar_usuario':
                (new UsuarioController())->deleteUsuarioAdmin();
                return null;
            case 'empleados':
                (new EmpleadoController())->indexEmpleado();
                return null;
            case 'guardar_empleado':
                (new EmpleadoController())->saveEmpleado();
                return null;
            case 'admin_animales':
                (new AnimalController())->indexAdmin();
                return null;
            case 'editar_animal_admin':
                (new AnimalController())->editAdmin();
                return null;
            case 'eliminar_animal_admin':
                (new AnimalController())->deleteAnimalAdmin();
                return null;
            case 'editar_consulta_admin':
                (new ConsultaController())->editConsultaAdmin();
                return null;
            case 'eliminar_consulta_admin':
                (new ConsultaController())->deleteConsultaAdmin();
                return null;
            case 'agregar_consulta_admin':
                (new ConsultaController())->indexAdmin();
                return null;
            case 'crear_usuario':
                (new UsuarioController())->addUsuarioAdmin();
                return null;

            default:
                return null;
        }
    }
}