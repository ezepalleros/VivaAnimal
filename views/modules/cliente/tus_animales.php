<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<div class="form-contenedor">
    <h2 class="subtitulo-destacado"><?= isset($animal) ? '✏️ Editar animal' : '➕ Agregar nuevo animal' ?></h2>
    <form action="index.php?modulo=<?= isset($animal) ? 'editar_animal' : 'guardar_animal' ?>" method="POST">
        <?php if (isset($animal)): ?>
            <input type="hidden" name="id_ani" value="<?= htmlspecialchars($animal['id_ani']) ?>">
        <?php endif; ?>
        <input type="text" name="nombre" placeholder="Nombre" required value="<?= htmlspecialchars($animal['nombre'] ?? '') ?>">
        <input type="number" name="edad" placeholder="Edad" required value="<?= htmlspecialchars($animal['edad'] ?? '') ?>">
        <input type="text" name="especie" placeholder="Especie" required value="<?= htmlspecialchars($animal['especie'] ?? '') ?>">
        <input type="text" name="raza" placeholder="Raza" required value="<?= htmlspecialchars($animal['raza'] ?? '') ?>">
        <button type="submit" class="btn-animado"><?= isset($animal) ? 'Actualizar' : 'Agregar' ?></button>
    </form>
</div>

<hr>

<h2 class="titulo-destacado" style="text-align:center;">🐾 Mis animales</h2>

<?php
if (isset($animales) && is_array($animales) && count($animales)) {
    foreach ($animales as $ani) {
        echo '<div class="form-contenedor" style="margin-bottom:32px;max-width:440px;">';
        echo '<strong style="font-size:1.5rem;display:block;margin-bottom:8px;">' . htmlspecialchars($ani['nombre']) . '</strong>';
        echo '<div class="animal-info" style="margin-bottom:16px;">';
        echo '<div><b>Especie:</b> ' . htmlspecialchars($ani['especie']) . '</div>';
        echo '<div><b>Raza:</b> ' . htmlspecialchars($ani['raza']) . '</div>';
        echo '<div><b>Edad:</b> ' . htmlspecialchars($ani['edad']) . ' años</div>';
        echo '</div>';
        echo '<div class="animal-actions" style="display:flex;gap:10px;justify-content:center;">';
        echo '<a href="index.php?modulo=tus_consultas&id=' . htmlspecialchars($ani['id_ani']) . '" class="btn-animado" style="min-width:90px;">🔍 Consultas</a>';
        echo '<a href="index.php?modulo=editar_animal&id=' . htmlspecialchars($ani['id_ani']) . '" class="btn-animado" style="min-width:90px;">✏️ Editar</a>';
        echo '<a href="index.php?modulo=eliminar_animal&id=' . htmlspecialchars($ani['id_ani']) . '" class="btn-animado" style="min-width:90px;" onclick="return confirm(\'¿Eliminar este animal?\')">🗑️ Eliminar</a>';
        echo '</div>';
        echo '</div>';
    }
} else {
    echo '<p>No se encontraron animales registrados.</p>';
}
?>
