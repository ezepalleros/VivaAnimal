<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h2><?= isset($animal) ? 'Editar animal' : 'Agregar nuevo animal' ?></h2>

<form action="index.php?modulo=<?= isset($animal) ? 'editar_animal' : 'guardar_animal' ?>" method="POST">
    <?php if (isset($animal)): ?>
        <input type="hidden" name="id_ani" value="<?= htmlspecialchars($animal['id_ani']) ?>">
    <?php endif; ?>

    <input type="text" name="nombre" placeholder="Nombre" required value="<?= htmlspecialchars($animal['nombre'] ?? '') ?>">
    <input type="number" name="edad" placeholder="Edad" required value="<?= htmlspecialchars($animal['edad'] ?? '') ?>">
    <input type="text" name="especie" placeholder="Especie" required value="<?= htmlspecialchars($animal['especie'] ?? '') ?>">
    <input type="text" name="raza" placeholder="Raza" required value="<?= htmlspecialchars($animal['raza'] ?? '') ?>">
    <button type="submit"><?= isset($animal) ? 'Actualizar' : 'Agregar' ?></button>
</form>

<hr>

<h3>Mis animales</h3>

<?php if (isset($animales) && is_array($animales)): ?>
    <ul>
        <?php foreach ($animales as $ani): ?>
            <li>
                <strong><?= htmlspecialchars($ani['nombre']) ?></strong>
                (<?= htmlspecialchars($ani['especie']) ?>, <?= htmlspecialchars($ani['raza']) ?>, <?= htmlspecialchars($ani['edad']) ?> años)
                
                <a href="index.php?modulo=tus_consultas&id=<?= htmlspecialchars($ani['id_ani']) ?>">Ver consultas</a>
                <a href="index.php?modulo=editar_animal&id=<?= htmlspecialchars($ani['id_ani']) ?>">Editar</a>
                <a href="index.php?modulo=eliminar_animal&id=<?= htmlspecialchars($ani['id_ani']) ?>" onclick="return confirm('¿Eliminar este animal?')">Eliminar</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No se encontraron animales registrados.</p>
<?php endif; ?>
