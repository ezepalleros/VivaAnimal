<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
    header("Location: index.php?modulo=login");
    exit;
}

echo '<h2 class="titulo-destacado" style="text-align:center;">Consultas de ' . htmlspecialchars($animal['nombre'] ?? '') . '</h2>';

if (isset($consultas) && count($consultas) > 0) {
    foreach ($consultas as $consulta) {
        echo '<div class="form-contenedor" style="margin-bottom:28px;max-width:480px;">';
        echo '<div class="animal-info" style="font-size:1.15rem;margin-bottom:10px;">';
        echo '<div><b>Fecha:</b> ' . htmlspecialchars($consulta['fecha']) . '</div>';
        echo '<div><b>Veterinario:</b> ' . htmlspecialchars($consulta['nombre_empleado']) . '</div>';
        echo '<div><b>Descripción:</b> ' . htmlspecialchars($consulta['descripcion']) . '</div>';
        echo '<div><b>Estado:</b> <span style="color:' . ($consulta['estado'] ? '#2e7d32' : '#e69500') . ';font-weight:bold;">' . ($consulta['estado'] ? 'Aceptada' : 'Pendiente') . '</span></div>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<div class="form-contenedor" style="max-width:480px;"><p>No tiene ninguna consulta.</p></div>';
}