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
$animales = $model->getAllAnimal();

if (!isset($mensaje)) $mensaje = '';
if (!isset($error)) $error = '';

echo '<h2 class="titulo-destacado" style="text-align:center;">Gestión de Animales</h2>';

echo '<div class="form-contenedor" style="max-width:1000px;margin-bottom:32px;">';
echo '<h3 class="subtitulo-destacado" style="margin-bottom:18px;">Lista de animales</h3>';

if (count($animales) > 0) {
    echo '<div style="overflow-x:auto;"><table class="table table-striped table-hover" style="width:100%;background:#fffbe6;border-radius:14px;box-shadow:0 2px 8px rgba(230,149,0,0.08);">';
    echo '<thead style="background:#ffe494;"><tr>
            <th style="padding: 10px;">ID</th>
            <th style="padding: 10px;">Nombre</th>
            <th style="padding: 10px;">Edad</th>
            <th style="padding: 10px;">Especie</th>
            <th style="padding: 10px;">Raza</th>
            <th style="padding: 10px;">ID Dueño</th>
            <th style="padding: 10px;">Acciones</th>
        </tr></thead><tbody>';
    foreach ($animales as $a) {
        $id = htmlspecialchars($a['id_ani']);
        $nombre = htmlspecialchars($a['nombre']);
        $edad = htmlspecialchars($a['edad']);
        $especie = htmlspecialchars($a['especie']);
        $raza = htmlspecialchars($a['raza']);
        $id_usuario = htmlspecialchars($a['id_usuario']);
        $id_url = urlencode($a['id_ani']);
        echo "<tr style='font-size:1.08rem;'>
            <td style='padding:8px;'>$id</td>
            <td style='padding:8px;'>$nombre</td>
            <td style='padding:8px;'>$edad</td>
            <td style='padding:8px;'>$especie</td>
            <td style='padding:8px;'>$raza</td>
            <td style='padding:8px;'>$id_usuario</td>
            <td style='padding:8px;'>
                <a href='index.php?modulo=editar_animal_admin&id=$id_url' class='btn-animado' style='padding:6px 14px;font-size:1rem;min-width:70px;max-width:110px;display:inline-block;'>✏️ Editar</a>
                <form action='index.php?modulo=admin_animales' method='POST' style='display:inline; margin:0; padding:0;'>
                    <input type='hidden' name='eliminar' value='1'>
                    <input type='hidden' name='id_ani' value='$id'>
                    <button type='submit' onclick=\"return confirm('¿Eliminar este animal?')\" class='btn-animado' style='padding:6px 14px;font-size:1rem;min-width:70px;max-width:110px;display:inline-block;'>🗑️ Eliminar</button>
                </form>
            </td>
        </tr>";
    }
    echo '</tbody></table></div>';
} else {
    echo '<p style="text-align:center;">No hay animales registrados.</p>';
}
echo '</div>';

// Mini formulario para agregar animal
echo '<div class="form-contenedor" style="max-width:600px;margin-bottom:32px;">';
echo '<h3 class="subtitulo-destacado" style="margin-bottom:18px;">Agregar nuevo animal</h3>';
echo '<form id="form-agregar-animal" action="index.php?modulo=admin_animales" method="POST">';
echo '<div style="display:flex;flex-wrap:wrap;gap:14px;align-items:flex-end;">';
echo '  <div style="flex:1 1 140px;"><label>Nombre:</label><input type="text" name="nombre" required class="form-control"></div>';
echo '  <div style="flex:1 1 100px;"><label>Edad:</label><input type="number" name="edad" min="0" required class="form-control"></div>';
echo '  <div style="flex:1 1 140px;"><label>Especie:</label><input type="text" name="especie" required class="form-control"></div>';
echo '  <div style="flex:1 1 140px;"><label>Raza:</label><input type="text" name="raza" required class="form-control"></div>';
echo '  <div style="flex:1 1 120px;"><label>ID Dueño:</label><input type="number" name="id_usuario" min="1" required class="form-control"></div>';
echo '  <button type="submit" class="btn-animado" style="min-width:120px;">Agregar</button>';
echo '</div>';
echo '</form>';
echo '</div>';

if (!empty($mensaje)) {
    echo '<div style="color: green; font-weight: bold;text-align:center;">' . htmlspecialchars($mensaje) . '</div>';
}
if (!empty($error)) {
    echo '<div style="color: red; font-weight: bold;text-align:center;">' . htmlspecialchars($error) . '</div>';
}

require_once 'models/usuario_model.php';
$usuarioModel = new UsuarioModel();
$usuarios = $usuarioModel->getAllUsuario();
$usuarios_ids = array_map(function($u){ return (string)$u['id_usu']; }, $usuarios);

$animales_js = [];
foreach ($animales as $a) {
    $animales_js[] = strtolower(trim($a['nombre'])) . '|' . $a['id_usuario'];
}

$GLOBALS['__extra_js_vars'] = [
    'usuariosValidos' => $usuarios_ids,
    'animalesRegistrados' => $animales_js
];
