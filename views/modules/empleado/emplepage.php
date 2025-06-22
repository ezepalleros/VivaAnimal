<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'empleado') {
    header("Location: index.php?modulo=login");
    exit;
}
?>
<div class="form-contenedor mt-5">
    <h2>¡Bienvenido, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?>! 🩺</h2>
    <p class="p-text text-center">
        Este es tu panel como empleado.<br>
        ¿Qué querés hacer hoy?
    </p>
    <div class="center-btn">
        <a href="index.php?modulo=emp_consultas" class="btn-animado">
            📋 Ver consultas pendientes y atendidas
        </a>
        <a href="index.php?modulo=emp_especialidad" class="btn-animado">
            🛠️ Editar especialidad
        </a>
    </div>
</div>
