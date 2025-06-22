<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h1>Bienvenido/a, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?> (Administrador)</h1>
<p>Este es tu panel de administración. Desde aquí podés gestionar los datos del sistema.</p>

<h3>Gestión del sistema</h3>
<ul>
    <li><a href="index.php?modulo=admin_usuarios">Ver usuarios</a></li>
    <li><a href="index.php?modulo=admin_animales">Ver animales</a></li>
    <li><a href="index.php?modulo=admin_consultas">Ver consultas</a></li>
</ul>
