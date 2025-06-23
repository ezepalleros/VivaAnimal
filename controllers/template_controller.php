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
            case 'tus_animales':
                (new AnimalController())->index();
                return null;
            case 'guardar_animal':
                (new AnimalController())->guardar();
                return null;
            case 'editar_animal':
                (new AnimalController())->editar();
                return null;
            case 'eliminar_animal':
                (new AnimalController())->eliminar();
                return null;
            case 'tus_consultas':
                (new ConsultaController())->getByAnimal();
                return null;
            case 'hacer_consulta':
                (new ConsultaController())->index();
                return null;

            // Empleado
            case 'emplepage':
                (new EmpleadoController())->verPanel();
                return null;
            case 'emp_consultas':
                (new ConsultaController())->getByEmpleado();
                return null;
            case 'emp_especialidad':
                (new EmpleadoController())->editarEspecialidad();
                return null;
            case 'aceptar_consulta':
                (new EmpleadoController())->aceptarConsulta();
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
                (new UsuarioController())->index();
                return null;
            case 'guardar_usuario':
                (new UsuarioController())->guardar();
                return null;
            case 'editar_usuario':
                (new UsuarioController())->editar();
                return null;
            case 'eliminar_usuario':
                (new UsuarioController())->eliminar();
                return null;
            case 'empleados':
                (new EmpleadoController())->index();
                return null;
            case 'guardar_empleado':
                (new EmpleadoController())->guardar();
                return null;
            case 'animales':
                (new AnimalController())->index();
                return null;
            case 'consultas':
                (new ConsultaController())->index();
                return null;
            case 'guardar_consulta':
                (new ConsultaController())->guardar();
                return null;
            case 'admin_animales':
                (new AnimalController())->indexAdmin();
                return null;
            case 'editar_animal_admin':
                (new AnimalController())->editarAdmin();
                return null;
            case 'eliminar_animal_admin':
                (new AnimalController())->eliminarAdmin();
                return null;
            case 'editar_consulta_admin':
                (new ConsultaController())->editarAdmin();
                return null;
            case 'eliminar_consulta_admin':
                (new ConsultaController())->eliminarAdmin();
                return null;
            case 'crear_usuario':
                (new UsuarioController())->crear_usuario();
                return null;

            default:
                return null;
        }
    }
}