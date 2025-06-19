<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'empleado') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h1>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></h1>

<p>¿Qué querés hacer?</p>

<ul>
    <li><a href="index.php?modulo=emp_consultas">Ver consultas pendientes y atendidas</a></li>
    <li><a href="index.php?modulo=emp_especialidad">Editar especialidad</a></li>
    <li><a href="index.php?modulo=logout">Cerrar sesión</a></li>
</ul>
