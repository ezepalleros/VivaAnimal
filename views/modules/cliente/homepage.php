<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
    header("Location: index.php?modulo=login");
    exit;
}
?>
<div class="form-contenedor mt-5">
    <h2>¡Bienvenido, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>! 🐾</h2>
    <p class="p-text text-center">
        Este es tu panel como cliente.<br>
        ¿Qué querés hacer hoy?
    </p>
    <div class="center-btn">
        <a href="index.php?modulo=tus_animales" class="btn-animado">
            🐶 Ver tus animales
        </a>
        <a href="index.php?modulo=hacer_consulta" class="btn-animado">
            🩺 Solicitar nueva consulta
        </a>
    </div>
</div>
