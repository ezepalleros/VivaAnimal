<div class="form-contenedor">
    <h2 class="mb-4 text-center">Solicitar nueva consulta</h2>
    <form method="POST" action="index.php?modulo=guardar_consulta">
        <label for="id_animal">Animal:</label>
        <select name="id_animal" class="form-control mb-3" required>
            <?php foreach ($animales as $ani): ?>
                <option value="<?= $ani['id_ani'] ?>">
                    <?= htmlspecialchars($ani['nombre']) ?> (<?= htmlspecialchars($ani['especie']) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <label for="fecha">Fecha (posterior a hoy):</label>
        <input type="date" name="fecha" class="form-control mb-3" min="<?= date('Y-m-d') ?>" required>

        <label for="descripcion">Descripción:</label>
        <textarea name="descripcion" class="form-control mb-3" rows="3" required></textarea>

        <label for="id_empleado">Veterinario:</label>
        <select name="id_empleado" class="form-control mb-3" required>
            <?php foreach ($empleados as $emp): ?>
                <option value="<?= $emp['id_emp'] ?>">
                    <?= htmlspecialchars($emp['nombre']) ?> (<?= htmlspecialchars($emp['especialidad']) ?>)
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit" class="btn-animado">Enviar solicitud</button>
    </form>
</div>