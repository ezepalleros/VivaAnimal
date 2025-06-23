<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'empleado') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h2 class="titulo-destacado" style="text-align:center;">Consultas pendientes</h2>

<?php if (!empty($consultasPendientes)): ?>
    <?php foreach ($consultasPendientes as $con): ?>
        <div class="form-contenedor" style="margin-bottom:28px;max-width:480px;">
            <div class="animal-info" style="font-size:1.15rem;margin-bottom:10px;">
                <div><b>Fecha:</b> <?= htmlspecialchars($con['fecha']) ?></div>
                <div><b>Animal:</b> <?= htmlspecialchars($con['nombre_animal']) ?></div>
                <div><b>Descripción:</b> <?= htmlspecialchars($con['descripcion']) ?></div>
            </div>
            <form action="index.php?modulo=aceptar_consulta" method="POST" style="width:100%;text-align:center;">
                <input type="hidden" name="id_con" value="<?= htmlspecialchars($con['id_con']) ?>">
                <button type="submit" class="btn-animado" onclick="return confirm('¿Aceptar esta consulta?')">Aceptar</button>
            </form>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="form-contenedor" style="max-width:480px;"><p>No hay consultas pendientes.</p></div>
<?php endif; ?>

<h2 class="titulo-destacado" style="text-align:center;">Consultas atendidas</h2>

<?php if (!empty($consultasAtendidas)): ?>
    <?php foreach ($consultasAtendidas as $con): ?>
        <div class="form-contenedor" style="margin-bottom:28px;max-width:480px;">
            <div class="animal-info" style="font-size:1.15rem;">
                <div><b>Fecha:</b> <?= htmlspecialchars($con['fecha']) ?></div>
                <div><b>Animal:</b> <?= htmlspecialchars($con['nombre_animal']) ?></div>
                <div><b>Descripción:</b> <?= htmlspecialchars($con['descripcion']) ?></div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="form-contenedor" style="max-width:480px;"><p>No hay consultas atendidas.</p></div>
<?php endif; ?>