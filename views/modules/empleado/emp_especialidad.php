<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'empleado') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<div class="form-contenedor">
    <h2 class="subtitulo-destacado">Editar especialidad</h2>
    <form method="POST" action="index.php?modulo=emp_especialidad">
        <label for="especialidad">Nueva especialidad:</label>
        <input type="text" name="especialidad" required value="<?= htmlspecialchars($empleado['especialidad'] ?? '') ?>">
        <button type="submit" class="btn-animado">Guardar</button>
    </form>
</div>
