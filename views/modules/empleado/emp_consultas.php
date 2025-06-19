<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'empleado') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h2>Consultas pendientes</h2>

<?php if (isset($consultasPendientes) && count($consultasPendientes) > 0): ?>
    <ul>
        <?php foreach ($consultasPendientes as $con): ?>
            <li>
                <strong>Fecha:</strong> <?= htmlspecialchars($con['fecha']) ?><br>
                <strong>Animal:</strong> <?= htmlspecialchars($con['nombre_animal']) ?><br>
                <strong>Descripción:</strong> <?= htmlspecialchars($con['descripcion']) ?><br>

                <form action="index.php?modulo=aceptar_consulta" method="POST" style="display:inline;">
                    <input type="hidden" name="id_con" value="<?= $con['id_con'] ?>">
                    <button type="submit" onclick="return confirm('¿Aceptar esta consulta?')">Aceptar</button>
                </form>
            </li>
            <hr>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay consultas pendientes.</p>
<?php endif; ?>

<h2>Consultas atendidas</h2>

<?php if (isset($consultasAtendidas) && count($consultasAtendidas) > 0): ?>
    <ul>
        <?php foreach ($consultasAtendidas as $con): ?>
            <li>
                <strong>Fecha:</strong> <?= htmlspecialchars($con['fecha']) ?><br>
                <strong>Animal:</strong> <?= htmlspecialchars($con['nombre_animal']) ?><br>
                <strong>Descripción:</strong> <?= htmlspecialchars($con['descripcion']) ?>
            </li>
            <hr>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>No hay consultas atendidas.</p>
<?php endif; ?>

<p><a href="index.php?modulo=emplepage">← Volver al panel</a></p>
