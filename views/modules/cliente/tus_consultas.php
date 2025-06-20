<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
    header("Location: index.php?modulo=login");
    exit;
}

echo '<h2>Consultas de ' . htmlspecialchars($animal['nombre'] ?? '') . '</h2>';

if (isset($consultas) && count($consultas) > 0) {
    echo '<ul>';
    foreach ($consultas as $consulta) {
        echo '<li>';
        echo '<strong>Fecha:</strong> ' . htmlspecialchars($consulta['fecha']) . '<br>';
        echo '<strong>Veterinario:</strong> ' . htmlspecialchars($consulta['nombre_empleado']) . '<br>';
        echo '<strong>Descripción:</strong> ' . htmlspecialchars($consulta['descripcion']) . '<br>';
        echo '<strong>Estado:</strong> ' . ($consulta['estado'] ? 'Aceptada' : 'Pendiente');
        echo '</li>';
        echo '<hr>';
    }
    echo '</ul>';
} else {
    echo '<p>No tiene ninguna consulta.</p>';
}

echo '<p><a href="index.php?modulo=tus_animales">← Volver a mis animales</a></p>';
?>