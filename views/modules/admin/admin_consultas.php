<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h2 class="titulo-destacado" style="text-align:center;">Gestión de Consultas</h2>

<div class="form-contenedor" style="max-width:1200px;margin-bottom:32px;">
    <h3 class="subtitulo-destacado" style="margin-bottom:18px;">Lista de consultas</h3>
    <?php if (!empty($consultas)): ?>
        <div style="overflow-x:auto;">
            <table class="table table-striped table-hover" style="width:100%;background:#fffbe6;border-radius:14px;box-shadow:0 2px 8px rgba(230,149,0,0.08);font-size:1.08rem;">
                <thead style="background:#ffe494;">
                    <tr>
                        <th style="padding: 10px;">ID</th>
                        <th style="padding: 10px;">Fecha</th>
                        <th style="padding: 10px;">Animal</th>
                        <th style="padding: 10px;">Dueño</th>
                        <th style="padding: 10px;">Veterinario</th>
                        <th style="padding: 10px;">Descripción</th>
                        <th style="padding: 10px;">Estado</th>
                        <th style="padding: 10px;">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultas as $c): ?>
                        <tr>
                            <td style="padding:8px;"><?= htmlspecialchars($c['id_con']) ?></td>
                            <td style="padding:8px;"><?= htmlspecialchars($c['fecha']) ?></td>
                            <td style="padding:8px;"><?= htmlspecialchars($c['nombre_animal']) ?></td>
                            <td style="padding:8px;"><?= htmlspecialchars($c['nombre_dueño']) ?></td>
                            <td style="padding:8px;"><?= htmlspecialchars($c['nombre_empleado']) ?></td>
                            <td style="padding:8px;"><?= htmlspecialchars($c['descripcion']) ?></td>
                            <td style="padding:8px;"><?= $c['estado'] ? 'Atendida' : 'Pendiente' ?></td>
                            <td style="padding:8px;">
                                <a href="index.php?modulo=editar_consulta_admin&id=<?= $c['id_con'] ?>" class="btn-animado" style="padding:6px 14px;font-size:1rem;min-width:70px;max-width:110px;display:inline-block;">✏️ Editar</a>
                                <form action="index.php?modulo=eliminar_consulta_admin" method="POST" style="display:inline; margin:0; padding:0;">
                                    <input type="hidden" name="id_con" value="<?= $c['id_con'] ?>">
                                    <button type="submit" onclick="return confirm('¿Eliminar esta consulta?')" class="btn-animado" style="padding:6px 14px;font-size:1rem;min-width:70px;max-width:110px;display:inline-block;">🗑️ Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p style="text-align:center;">No hay consultas registradas.</p>
    <?php endif; ?>
</div>

<div class="form-contenedor" style="max-width:600px;margin-bottom:32px;">
    <h3 class="subtitulo-destacado" style="margin-bottom:18px;">Agregar nueva consulta</h3>
    <form action="index.php?modulo=admin_consultas" method="POST">
        <label>Fecha:</label>
        <input type="date" name="fecha" required class="form-control">
        <label>Descripción:</label>
        <input type="text" name="descripcion" required class="form-control">
        <label>Animal:</label>
        <select name="id_animal" required class="form-control">
            <?php foreach ($animales as $ani): ?>
                <option value="<?= $ani['id_ani'] ?>"><?= htmlspecialchars($ani['nombre']) ?> (Dueño: <?= htmlspecialchars($ani['nombre_dueño']) ?>)</option>
            <?php endforeach; ?>
        </select>
        <label>Veterinario:</label>
        <select name="id_empleado" required class="form-control">
            <?php foreach ($empleados as $emp): ?>
                <option value="<?= $emp['id_emp'] ?>"><?= htmlspecialchars($emp['nombre']) ?> (<?= htmlspecialchars($emp['especialidad']) ?>)</option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="agregar_consulta" value="1" class="btn-animado" style="margin-top:10px;">Agregar</button>
    </form>
</div>

<?php if (!empty($mensaje)): ?>
    <div style="color: green; font-weight: bold;text-align:center;"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div style="color: red; font-weight: bold;text-align:center;"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>