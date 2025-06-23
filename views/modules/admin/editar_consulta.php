<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<div class="form-contenedor">
    <h2 class="subtitulo-destacado">Editar consulta</h2>

    <?php if (!empty($error)): ?>
        <div style="color: red; font-weight: bold;text-align:center;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form id="form-editar-consulta" action="index.php?modulo=editar_consulta_admin" method="POST">
        <input type="hidden" name="id_con" value="<?= htmlspecialchars($consulta['id_con']) ?>">

        <label for="fecha">Fecha:</label>
        <input type="date" id="fecha" name="fecha" required value="<?= htmlspecialchars($consulta['fecha']) ?>">

        <label for="descripcion">Descripción:</label>
        <input type="text" id="descripcion" name="descripcion" required value="<?= htmlspecialchars($consulta['descripcion']) ?>">

        <label for="id_animal">Animal:</label>
        <select id="id_animal" name="id_animal" required>
            <?php foreach ($animales as $ani): ?>
                <option value="<?= $ani['id_ani'] ?>" <?= $ani['id_ani'] == $consulta['id_animal'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($ani['nombre']) ?> (Dueño: <?= htmlspecialchars($ani['nombre_dueño']) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="id_empleado">Veterinario:</label>
        <select id="id_empleado" name="id_empleado" required>
            <?php foreach ($empleados as $emp): ?>
                <option value="<?= $emp['id_emp'] ?>" <?= $emp['id_emp'] == $consulta['id_empleado'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($emp['nombre']) ?> (<?= htmlspecialchars($emp['especialidad']) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="0" <?= $consulta['estado'] ? '' : 'selected' ?>>Pendiente</option>
            <option value="1" <?= $consulta['estado'] ? 'selected' : '' ?>>Atendida</option>
        </select>

        <button type="submit" class="btn-animado">Guardar cambios</button>
        <a href="index.php?modulo=admin_consultas" class="btn-animado" style="margin-top:10px;text-align:center;">Cancelar</a>
    </form>
</div>