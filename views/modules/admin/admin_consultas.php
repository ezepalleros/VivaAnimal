<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h2>Gestión de Consultas</h2>

<?php if (!empty($consultas)): ?>
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; font-size: 12px;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Animal</th>
                <th>Dueño</th>
                <th>Veterinario</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consultas as $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['id_con']) ?></td>
                    <td><?= htmlspecialchars($c['fecha']) ?></td>
                    <td><?= htmlspecialchars($c['nombre_animal']) ?></td>
                    <td><?= htmlspecialchars($c['nombre_dueño']) ?></td>
                    <td><?= htmlspecialchars($c['nombre_empleado']) ?></td>
                    <td><?= htmlspecialchars($c['descripcion']) ?></td>
                    <td><?= $c['estado'] ? 'Atendida' : 'Pendiente' ?></td>
                    <td>
                        <a href="index.php?modulo=editar_consulta_admin&id=<?= $c['id_con'] ?>">Editar</a>
                        |
                        <form action="index.php?modulo=eliminar_consulta_admin" method="POST" style="display:inline;">
                            <input type="hidden" name="id_con" value="<?= $c['id_con'] ?>">
                            <button type="submit" onclick="return confirm('¿Eliminar esta consulta?')" style="background:none; border:none; color:blue; cursor:pointer; text-decoration:underline;">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>z
<?php else: ?>
    <p>No hay consultas registradas.</p>
<?php endif; ?>

<hr>
<h3>Agregar nueva consulta</h3>
<form action="index.php?modulo=admin_consultas" method="POST">
    <label>Fecha: <input type="date" name="fecha" required></label><br>
    <label>Descripción: <input type="text" name="descripcion" required></label><br>
    <label>Animal:
        <select name="id_animal" required>
            <?php foreach ($animales as $ani): ?>
                <option value="<?= $ani['id_ani'] ?>"><?= htmlspecialchars($ani['nombre']) ?> (Dueño: <?= htmlspecialchars($ani['nombre_dueño']) ?>)</option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <label>Veterinario:
        <select name="id_empleado" required>
            <?php foreach ($empleados as $emp): ?>
                <option value="<?= $emp['id_emp'] ?>"><?= htmlspecialchars($emp['nombre']) ?> (<?= htmlspecialchars($emp['especialidad']) ?>)</option>
            <?php endforeach; ?>
        </select>
    </label><br>
    <button type="submit" name="agregar_consulta" value="1">Agregar</button>
</form>
<?php if (!empty($mensaje)): ?>
    <div style="color: green; font-weight: bold;"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div style="color: red; font-weight: bold;"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<p><a href="index.php?modulo=adminpage">← Volver al panel de administración</a></p>
