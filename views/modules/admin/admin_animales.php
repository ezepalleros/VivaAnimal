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

if (!isset($mensaje)) $mensaje = '';
if (!isset($error)) $error = '';

echo '
<h2>Gestión de Animales</h2>
<h3>Lista de animales</h3>
';

if (count($animales) > 0) {
    echo '
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
    ';
    foreach ($animales as $a) {
        $id = htmlspecialchars($a['id_ani']);
        $nombre = htmlspecialchars($a['nombre']);
        $edad = htmlspecialchars($a['edad']);
        $especie = htmlspecialchars($a['especie']);
        $raza = htmlspecialchars($a['raza']);
        $id_usuario = htmlspecialchars($a['id_usuario']);
        $id_url = urlencode($a['id_ani']);
        echo "
        <tr>
            <td>$id</td>
            <td>$nombre</td>
            <td>$edad</td>
            <td>$especie</td>
            <td>$raza</td>
            <td>$id_usuario</td>
            <td>
                <a href='index.php?modulo=editar_animal_admin&id=$id_url'>Editar</a>
                |
                <form action='index.php?modulo=admin_animales' method='POST' style='display:inline;'>
                    <input type='hidden' name='eliminar' value='1'>
                    <input type='hidden' name='id_ani' value='$id'>
                    <button type='submit' onclick=\"return confirm('¿Eliminar este animal?')\">Eliminar</button>
                </form>
            </td>
        </tr>
        ";
    }
    echo '
        </tbody>
    </table>
    ';
} else {
    echo '<p>No hay animales registrados.</p>';
}

echo '
<hr>
<h3>Agregar nuevo animal</h3>
<form action="index.php?modulo=admin_animales" method="POST">
    <label>Nombre: <input type="text" name="nombre" required></label><br>
    <label>Edad: <input type="number" name="edad" required></label><br>
    <label>Especie: <input type="text" name="especie" required></label><br>
    <label>Raza: <input type="text" name="raza" required></label><br>
    <label>ID Dueño: <input type="number" name="id_usuario" required></label><br>
    <button type="submit">Agregar</button>
</form>
';

if (!empty($mensaje)) {
    echo '<div style="color: green; font-weight: bold;">' . htmlspecialchars($mensaje) . '</div>';
}
if (!empty($error)) {
    echo '<div style="color: red; font-weight: bold;">' . htmlspecialchars($error) . '</div>';
}

echo '<p><a href="index.php?modulo=adminpage">← Volver al panel de administración</a></p>';

?>
