<?php
if (!isset($_SESSION['cliente']) || $_SESSION['cliente']['rol'] !== 'cliente') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h1>Bienvenido, <?= htmlspecialchars($_SESSION['cliente']['nombre']) ?>!</h1>
<p>Este es tu panel como cliente.</p>

<ul>
    <li><a href="index.php?modulo=tus_animales">Ver tus animales</a></li>
    <li><a href="index.php?modulo=hacer_consulta">Solicitar nueva consulta</a></li>
    <li><a href="index.php?modulo=logout">Cerrar sesión</a></li>
</ul>
