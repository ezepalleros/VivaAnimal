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
    <h2 class="subtitulo-destacado">Editar usuario</h2>
    <form action="index.php?modulo=editar_usuario" method="POST">
        <input type="hidden" name="id_usu" value="<?= htmlspecialchars($usuario['id_usu']) ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required value="<?= htmlspecialchars($usuario['nombre']) ?>">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required value="<?= htmlspecialchars($usuario['email']) ?>">

        <label for="telefono">Teléfono:</label>
        <input type="text" id="telefono" name="telefono" value="<?= htmlspecialchars($usuario['telefono']) ?>">

        <label for="direccion">Dirección:</label>
        <input type="text" id="direccion" name="direccion" value="<?= htmlspecialchars($usuario['direccion']) ?>">

        <label for="rol">Rol:</label>
        <select id="rol" name="rol" required>
            <option value="cliente" <?= $usuario['rol'] === 'cliente' ? 'selected' : '' ?>>Cliente</option>
            <option value="empleado" <?= $usuario['rol'] === 'empleado' ? 'selected' : '' ?>>Empleado</option>
            <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Admin</option>
        </select>

        <?php if ($usuario['rol'] === 'empleado'): ?>
            <label for="especialidad">Especialidad:</label>
            <input type="text" id="especialidad" name="especialidad" value="<?= htmlspecialchars($usuario['especialidad'] ?? '') ?>">

            <label for="contratacion">Fecha de contratación:</label>
            <input type="date" id="contratacion" name="contratacion" value="<?= htmlspecialchars($usuario['contratacion'] ?? '') ?>">
        <?php endif; ?>

        <button type="submit" class="btn-animado">Guardar cambios</button>
        <a href="index.php?modulo=admin_usuarios" class="btn-animado" style="margin-top:10px;text-align:center;">Cancelar</a>
    </form>
</div>