<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h2>Editar usuario</h2>

<form action="index.php?modulo=editar_usuario" method="POST">
    <input type="hidden" name="id_usu" value="<?= htmlspecialchars($usuario['id_usu']) ?>">

    <label>Nombre:<br>
        <input type="text" name="nombre" required value="<?= htmlspecialchars($usuario['nombre']) ?>">
    </label>
    <br><br>

    <label>Email:<br>
        <input type="email" name="email" required value="<?= htmlspecialchars($usuario['email']) ?>">
    </label>
    <br><br>

    <label>Teléfono:<br>
        <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">
    </label>
    <br><br>

    <label>Dirección:<br>
        <input type="text" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>">
    </label>
    <br><br>

    <label>Rol:<br>
        <select name="rol" required>
            <option value="cliente" <?= $usuario['rol'] === 'cliente' ? 'selected' : '' ?>>Cliente</option>
            <option value="empleado" <?= $usuario['rol'] === 'empleado' ? 'selected' : '' ?>>Empleado</option>
            <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>
    </label>
    <br><br>

    <?php if ($usuario['rol'] === 'empleado'): ?>
        <label>Especialidad:<br>
            <input type="text" name="especialidad" value="<?= htmlspecialchars($usuario['especialidad'] ?? '') ?>" disabled>
        </label>
        <br><br>
        <label>Fecha de contratación:<br>
            <input type="date" name="contratacion" value="<?= htmlspecialchars($usuario['contratacion'] ?? '') ?>" disabled>
        </label>
        <br><br>
    <?php endif; ?>

    <button type="submit">Guardar cambios</button>
    <a href="index.php?modulo=