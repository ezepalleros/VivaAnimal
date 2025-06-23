<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!class_exists('Routes')) {
    require_once dirname(__DIR__) . '/models/routes.php';
}
$ruta = Routes::GetRoutes();

// Determinar página principal según el rol
$pagina = "index.php?modulo=login";
if (isset($_SESSION['usuario']['rol'])) {
    switch ($_SESSION['usuario']['rol']) {
        case 'admin':
            $pagina = "index.php?modulo=adminpage";
            break;
        case 'empleado':
            $pagina = "index.php?modulo=emplepage";
            break;
        case 'cliente':
            $pagina = "index.php?modulo=homepage";
            break;
    }
}
?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Tu CSS personalizado -->
<link rel="stylesheet" href="<?php echo $ruta; ?>css/style.css">

<body>
<div id="emoji-bg"></div>
<header style="background-color: #ffe494;" class="py-4 mb-4 shadow">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 text-start">
                <a href="<?php echo $pagina; ?>">
                    <img src="<?php echo $ruta; ?>img/logo.jpg" style="max-width: 220px;">
                </a>
            </div>
            <div class="col-6 text-end">
                <?php if (isset($_SESSION['usuario'])): ?>
                    <div class="dropdown">
                        <a href="#" role="button" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?php echo $ruta; ?>img/user_logo.png" alt="Usuario" style="max-width: 48px; cursor: pointer;">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                            <li>
                                <?php
                                // Determinar la homepage según el rol
                                $home = "index.php?modulo=login";
                                if (isset($_SESSION['usuario']['rol'])) {
                                    switch ($_SESSION['usuario']['rol']) {
                                        case 'admin':
                                            $home = "index.php?modulo=adminpage";
                                            break;
                                        case 'empleado':
                                            $home = "index.php?modulo=emplepage";
                                            break;
                                        case 'cliente':
                                            $home = "index.php?modulo=homepage";
                                            break;
                                    }
                                }
                                ?>
                                <a class="dropdown-item" href="<?php echo $home; ?>">Ir a mi página principal</a>
                            </li>
                            <li><a class="dropdown-item" href="index.php?modulo=logout">Cerrar sesión</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</header>
<main>
