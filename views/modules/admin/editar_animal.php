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
    <h2 class="subtitulo-destacado">Editar animal</h2>

    <?php if (!empty($error)): ?>
        <div style="color: red; font-weight: bold;text-align:center;"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form id="form-editar-animal" action="index.php?modulo=editar_animal_admin" method="POST">
        <input type="hidden" name="id_ani" value="<?= htmlspecialchars($animal['id_ani']) ?>">

        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required value="<?= htmlspecialchars($animal['nombre']) ?>">

        <label for="edad">Edad:</label>
        <input type="number" id="edad" name="edad" required value="<?= htmlspecialchars($animal['edad']) ?>">

        <label for="especie">Especie:</label>
        <input type="text" id="especie" name="especie" required value="<?= htmlspecialchars($animal['especie']) ?>">

        <label for="raza">Raza:</label>
        <input type="text" id="raza" name="raza" required value="<?= htmlspecialchars($animal['raza']) ?>">

        <label for="id_usuario">ID Dueño:</label>
        <input type="number" id="id_usuario" name="id_usuario" required value="<?= htmlspecialchars($animal['id_usuario']) ?>">

        <button type="submit" class="btn-animado">Guardar cambios</button>
        <a href="index.php?modulo=admin_animales" class="btn-animado" style="margin-top:10px;text-align:center;">Cancelar</a>
    </form>
</div>