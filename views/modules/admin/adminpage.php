<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: index.php?modulo=login");
    exit;
}
?>
<div class="form-contenedor mt-5">
    <h2>¡Bienvenido/a, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>! 🛡️</h2>
    <p class="p-text text-center">
        Este es tu panel de administración.<br>
        Desde aquí podés gestionar los datos del sistema.
    </p>
    <div class="center-btn">
        <a href="index.php?modulo=admin_usuarios" class="btn-animado">
            👤 Ver usuarios
        </a>
        <a href="index.php?modulo=admin_animales" class="btn-animado">
            🐾 Ver animales
        </a>
        <a href="index.php?modulo=admin_consultas" class="btn-animado">
            📋 Ver consultas
        </a>
    </div>
</div>
