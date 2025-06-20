<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: index.php?modulo=login");
    exit;
}

require_once 'models/animal_model.php';
$model = new AnimalModel();
$animales = $model->getAll();
?>

<h2>Gestión de Animales</h2>

<h3>Lista de animales</h3>

<?php if (count($animales) > 0): ?>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Edad</th>
                <th>Especie</th>
                <th>Raza</th>
                <th>ID Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($animales as $a): ?>
                <tr>
                    <td><?= htmlspecialchars($a['id_ani']) ?></td>
                    <td><?= htmlspecialchars($a['nombre']) ?></td>
                    <td><?= htmlspecialchars($a['edad']) ?></td>
                    <td><?= htmlspecialchars($a['especie']) ?></td>
                    <td><?= htmlspecialchars($a['raza']) ?></td>
                    <td><?= htmlspecialchars($a['id_usuario']) ?></td>
                    <td>
                        <!-- Editar -->
                        <a href="index.php?modulo=editar_animal_admin&id=<?= urlencode($a['id_ani']) ?>">Editar</a>
                        |
                        <!-- Eliminar -->
                        <form action="index.php?modulo=admin_animales" method="POST" style="display:inline;">
                            <input type="hidden" name="eliminar" value="1">
                            <input type="hidden" name="id_ani" value="<?= $a['id_ani'] ?>">
                            <button type="submit" onclick="return confirm('¿Eliminar este animal?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
<?php else: ?>
    <p>No hay animales registrados.</p>
<?php endif; ?>

<hr>

<!-- Formulario para agregar nuevo animal -->
<h3>Agregar nuevo animal</h3>
<form action="index.php?modulo=admin_animales" method="POST">
    <label>Nombre: <input type="text" name="nombre" required></label><br>
    <label>Edad: <input type="number" name="edad" required></label><br>
    <label>Especie: <input type="text" name="especie" required></label><br>
    <label>Raza: <input type="text" name="raza" required></label><br>
    <label>ID Dueño: <input type="number" name="id_usuario" required></label><br>
    <button type="submit">Agregar</button>
</form>

<?php if (!empty($mensaje)): ?>
    <div style="color: green; font-weight: bold;"><?= htmlspecialchars($mensaje) ?></div>
<?php endif; ?>
<?php if (!empty($error)): ?>
    <div style="color: red; font-weight: bold;"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<p><a href="index.php?modulo=adminpage">← Volver al panel de administración</a></p>
