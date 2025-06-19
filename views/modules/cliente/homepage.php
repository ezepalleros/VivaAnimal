<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
    header("Location: index.php?modulo=login");
    exit;
}
?>
<h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>!</h1>
<p>Este es tu panel como cliente.</p>

<ul>
    <li><a href="index.php?modulo=tus_animales">Ver tus animales</a></li>
    <li><a href="index.php?modulo=hacer_consulta">Solicitar nueva consulta</a></li>
    <li><a href="index.php?modulo=logout">Cerrar sesión</a></li>
</ul>
