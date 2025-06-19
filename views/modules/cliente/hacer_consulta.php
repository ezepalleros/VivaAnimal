<?php
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'cliente') {
    header("Location: index.php?modulo=login");
    exit;
}
?>

<h2>Solicitar nueva consulta</h2>

<form action="index.php?modulo=guardar_consulta" method="POST">
    <!-- Animal -->
    <label for="id_animal">Animal:</label>
    <select name="id_animal" required>
        <?php foreach ($animales as $ani): ?>
            <option value="<?= $ani['id_ani'] ?>"><?= htmlspecialchars($ani['nombre']) ?> (<?= $ani['especie'] ?>)</option>
        <?php endforeach; ?>
    </select><br><br>

    <!-- Fecha -->
    <label for="fecha">Fecha (posterior a hoy):</label>
    <input type="date" name="fecha" min="<?= date('Y-m-d') ?>" required><br><br>

    <!-- Descripción -->
    <label for="descripcion">Descripción:</label><br>
    <textarea name="descripcion" rows="4" cols="50" required></textarea><br><br>

    <!-- Veterinario -->
    <label for="id_empleado">Veterinario:</label>
    <select name="id_empleado" required>
        <?php foreach ($empleados as $emp): ?>
            <option value="<?= $emp['id_emp'] ?>"><?= htmlspecialchars($emp['nombre']) ?> (<?= $emp['especialidad'] ?>)</option>
        <?php endforeach; ?>
    </select><br><br>

    <button type="submit">Enviar solicitud</button>
</form>

<p><a href="index.php?modulo=homepage">← Volver al inicio</a></p>
