<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'empleado') {
    header("Location: index.php?modulo=login");
    exit;
}

echo '<h2>Consultas pendientes</h2>';

if (!empty($consultasPendientes)) {
    echo '<ul>';
    foreach ($consultasPendientes as $con) {
        echo '<li>';
        echo '<strong>Fecha:</strong> ' . htmlspecialchars($con['fecha']) . '<br>';
        echo '<strong>Animal:</strong> ' . htmlspecialchars($con['nombre_animal']) . '<br>';
        echo '<strong>Descripción:</strong> ' . htmlspecialchars($con['descripcion']) . '<br>';
        echo '<form action="index.php?modulo=aceptar_consulta" method="POST" style="display:inline;">';
        echo '<input type="hidden" name="id_con" value="' . htmlspecialchars($con['id_con']) . '">';
        echo '<button type="submit" onclick="return confirm(\'¿Aceptar esta consulta?\')">Aceptar</button>';
        echo '</form>';
        echo '</li>';
        echo '<hr>';
    }
    echo '</ul>';
} else {
    echo '<p>No hay consultas pendientes.</p>';
}

echo '<h2>Consultas atendidas</h2>';

if (!empty($consultasAtendidas)) {
    echo '<ul>';
    foreach ($consultasAtendidas as $con) {
        echo '<li>';
        echo '<strong>Fecha:</strong> ' . htmlspecialchars($con['fecha']) . '<br>';
        echo '<strong>Animal:</strong> ' . htmlspecialchars($con['nombre_animal']) . '<br>';
        echo '<strong>Descripción:</strong> ' . htmlspecialchars($con['descripcion']);
        echo '</li>';
        echo '<hr>';
    }
    echo '</ul>';
} else {
    echo '<p>No hay consultas atendidas.</p>';
}

echo '<p><a href="index.php?modulo=emplepage">← Volver al panel</a></p>';
?>
