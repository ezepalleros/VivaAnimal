<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h2>Consultas de <?= htmlspecialchars($animal['nombre'] ?? '') ?></h2>

<?php if (isset($consultas) && count($consultas) > 0): ?>
    <ul>
        <?php foreach ($consultas as $consulta): ?>
            <li>
                <strong>Fecha:</strong> <?= htmlspecialchars($consulta['fecha']) ?><br>
                <strong>Veterinario:</strong> <?= htmlspecialchars($consulta['nombre_empleado']) ?><br>
                <strong>Descripción:</strong> <?= htmlspecialchars($consulta['descripcion']) ?><br>
                <strong>Estado:</strong> <?= $consulta['estado'] ? 'Aceptada' : 'Pendiente' ?>
            </li>
            <hr>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No tiene ninguna consulta.</p>
<?php endif; ?>

<p><a href="index.php?modulo=tus_animales">← Volver a mis animales</a></p>
