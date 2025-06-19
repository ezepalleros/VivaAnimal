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
