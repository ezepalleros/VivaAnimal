<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
    header("Location: index.php?modulo=login");
    exit;
}

echo '<h2>' . (isset($animal) ? 'Editar animal' : 'Agregar nuevo animal') . '</h2>';

echo '<form action="index.php?modulo=' . (isset($animal) ? 'editar_animal' : 'guardar_animal') . '" method="POST">';
if (isset($animal)) {
    echo '<input type="hidden" name="id_ani" value="' . htmlspecialchars($animal['id_ani']) . '">';
}
echo '<input type="text" name="nombre" placeholder="Nombre" required value="' . htmlspecialchars($animal['nombre'] ?? '') . '">';
echo '<input type="number" name="edad" placeholder="Edad" required value="' . htmlspecialchars($animal['edad'] ?? '') . '">';
echo '<input type="text" name="especie" placeholder="Especie" required value="' . htmlspecialchars($animal['especie'] ?? '') . '">';
echo '<input type="text" name="raza" placeholder="Raza" required value="' . htmlspecialchars($animal['raza'] ?? '') . '">';
echo '<button type="submit">' . (isset($animal) ? 'Actualizar' : 'Agregar') . '</button>';
echo '</form>';

echo '<hr>';

echo '<h3>Mis animales</h3>';

if (isset($animales) && is_array($animales)) {
    echo '<ul>';
    foreach ($animales as $ani) {
        echo '<li>';
        echo '<strong>' . htmlspecialchars($ani['nombre']) . '</strong>';
        echo '(' . htmlspecialchars($ani['especie']) . ', ' . htmlspecialchars($ani['raza']) . ', ' . htmlspecialchars($ani['edad']) . ' años)';
        echo '<a href="index.php?modulo=tus_consultas&id=' . htmlspecialchars($ani['id_ani']) . '">Ver consultas</a>';
        echo '<a href="index.php?modulo=editar_animal&id=' . htmlspecialchars($ani['id_ani']) . '">Editar</a>';
        echo '<a href="index.php?modulo=eliminar_animal&id=' . htmlspecialchars($ani['id_ani']) . '" onclick="return confirm(\'¿Eliminar este animal?\')">Eliminar</a>';
        echo '</li>';
    }
    echo '</ul>';
} else {
    echo '<p>No se encontraron animales registrados.</p>';
}
?>
