<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h2>Editar consulta</h2>

<form action="index.php?modulo=editar_consulta_admin" method="POST">
    <input type="hidden" name="id_con" value="<?= htmlspecialchars($consulta['id_con']) ?>">

    <label>Fecha:<br>
        <input type="date" name="fecha" required value="<?= htmlspecialchars($consulta['fecha']) ?>">
    </label>
    <br><br>

    <label>Descripción:<br>
        <input type="text" name="descripcion" required value="<?= htmlspecialchars($consulta['descripcion']) ?>">
    </label>
    <br><br>

    <label>Animal:<br>
        <select name="id_animal" required>
            <?php foreach ($animales as $ani): ?>
                <option value="<?= $ani['id_ani'] ?>" <?= $ani['id_ani'] == $consulta['id_animal'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($ani['nombre']) ?> (Dueño: <?= htmlspecialchars($ani['nombre_dueño']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <br><br>

    <label>Veterinario:<br>
        <select name="id_empleado" required>
            <?php foreach ($empleados as $emp): ?>
                <option value="<?= $emp['id_emp'] ?>" <?= $emp['id_emp'] == $consulta['id_empleado'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($emp['nombre']) ?> (<?= htmlspecialchars($emp['especialidad']) ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </label>
    <br><br>

    <label>Estado:<br>
        <select name="estado" required>
            <option value="0" <?= $consulta['estado'] ? '' : 'selected' ?>>Pendiente</option>
            <option value="1" <?= $consulta['estado'] ? 'selected' : '' ?>>Atendida</option>
        </select>
    </label>
    <br><br>

    <button type="submit">Guardar cambios</button>
    <a href="index.php?modulo