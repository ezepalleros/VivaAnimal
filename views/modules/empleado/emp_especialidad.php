<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'empleado') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h2>Editar especialidad</h2>

<form method="POST" action="index.php?modulo=emp_especialidad">
    <label for="especialidad">Nueva especialidad:</label><br>
    <input type="text" name="especialidad" required value="<?= htmlspecialchars($empleado['especialidad'] ?? '') ?>"><br><br>
    <button type="submit">Guardar</button>
</form>

<p><a href="index.php?modulo=emplepage">← Volver al panel</a></p>
