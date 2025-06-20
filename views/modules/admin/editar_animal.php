<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h2>Editar animal</h2>

<?php if (!empty($error)): ?>
    <div style="color: red; font-weight: bold;"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form action="index.php?modulo=editar_animal_admin" method="POST">
    <input type="hidden" name="id_ani" value="<?= htmlspecialchars($animal['id_ani']) ?>">

    <label>Nombre:<br>
        <input type="text" name="nombre" required value="<?= htmlspecialchars($animal['nombre']) ?>">
    </label>
    <br><br>

    <label>Edad:<br>
        <input type="number" name="edad" required value="<?= htmlspecialchars($animal['edad']) ?>">
    </label>
    <br><br>

    <label>Especie:<br>
        <input type="text" name="especie" required value="<?= htmlspecialchars($animal['especie']) ?>">
    </label>
    <br><br>

    <label>Raza:<br>
        <input type="text" name="raza" required value="<?= htmlspecialchars($animal['raza']) ?>">
    </label>
    <br><br>

    <label>ID Dueño:<br>
        <input type="number" name="id_usuario" required value="<?= htmlspecialchars($animal['id_usuario']) ?>">
    </label>
    <br><br>

    <button type="submit">Guardar cambios</button>
    <a href="index.php?modulo=admin_animales">Cancelar</a>
</form>