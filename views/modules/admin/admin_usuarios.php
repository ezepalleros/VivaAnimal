<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: index.php?modulo=login");
    exit;
}

require_once 'models/usuario_model.php';
$model = new UsuarioModel();
$usuarios = $model->getAll();

$usuarios_por_rol = [
    'cliente' => [],
    'empleado' => [],
    'admin' => []
];

foreach ($usuarios as $u) {
    $rol = $u['rol'];
    if (isset($usuarios_por_rol[$rol])) {
        $usuarios_por_rol[$rol][] = $u;
    }
}

echo '<h2 class="titulo-destacado" style="text-align:center;">Usuarios por Rol</h2>';

foreach ($usuarios_por_rol as $rol => $lista_usuarios) {
    echo '<div class="form-contenedor" style="margin-bottom:32px;max-width:900px;">';
    echo '<h3 class="subtitulo-destacado" style="margin-bottom:18px;">' . ucfirst($rol) . 's</h3>';

    // Tabla de usuarios
    if (count($lista_usuarios) > 0) {
        echo '<div style="overflow-x:auto;"><table class="table table-striped table-hover" style="width:100%;background:#fffbe6;border-radius:14px;box-shadow:0 2px 8px rgba(230,149,0,0.08);">';
        echo '<thead style="background:#ffe494;"><tr>
                <th style="padding: 10px;">ID</th>
                <th style="padding: 10px;">Nombre</th>
                <th style="padding: 10px;">Email</th>
                <th style="padding: 10px;">Teléfono</th>
                <th style="padding: 10px;">Dirección</th>';
        if ($rol === 'empleado') {
            echo '<th style="padding: 10px;">Especialidad</th>
                  <th style="padding: 10px;">Fecha Contratación</th>';
        }
        echo '<th style="padding: 10px;">Acciones</th>
            </tr></thead><tbody>';
        foreach ($lista_usuarios as $u) {
            echo '<tr style="font-size:1.08rem;">';
            echo '<td style="padding: 8px;">' . htmlspecialchars($u['id_usu']) . '</td>';
            echo '<td style="padding: 8px;">' . htmlspecialchars($u['nombre']) . '</td>';
            echo '<td style="padding: 8px;">' . htmlspecialchars($u['email']) . '</td>';
            echo '<td style="padding: 8px;">' . htmlspecialchars($u['telefono']) . '</td>';
            echo '<td style="padding: 8px;">' . htmlspecialchars($u['direccion']) . '</td>';
            if ($rol === 'empleado') {
                echo '<td style="padding: 8px;">' . htmlspecialchars($u['especialidad'] ?? '') . '</td>';
                echo '<td style="padding: 8px;">' . htmlspecialchars($u['contratacion'] ?? '') . '</td>';
            }
            echo '<td style="padding: 8px;">
                    <a href="index.php?modulo=editar_usuario&id=' . urlencode($u['id_usu']) . '" class="btn-animado" style="padding:6px 14px;font-size:1rem;min-width:70px;max-width:110px;display:inline-block;">✏️ Editar</a>
                    <form action="index.php?modulo=eliminar_usuario" method="POST" style="display:inline; margin: 0; padding: 0;">
                        <input type="hidden" name="id_usu" value="' . htmlspecialchars($u['id_usu']) . '">
                        <button type="submit" onclick="return confirm(\'¿Eliminar este usuario?\')" class="btn-animado" style="padding:6px 14px;font-size:1rem;min-width:70px;max-width:110px;display:inline-block;">🗑️ Eliminar</button>
                    </form>
                </td>';
            echo '</tr>';
        }
        echo '</tbody></table></div>';
    } else {
        echo '<p style="text-align:center;">No hay usuarios con rol ' . htmlspecialchars($rol) . '.</p>';
    }

    // Mini formulario para agregar usuario debajo de cada rol
    echo '<form action="index.php?modulo=crear_usuario" method="POST" style="margin-top:22px;">';
    echo '<input type="hidden" name="rol" value="' . htmlspecialchars($rol) . '">';
    echo '<div style="display:flex;flex-wrap:wrap;gap:14px;align-items:flex-end;">';
    echo '  <div style="flex:1 1 160px;"><label>Nombre:</label><input type="text" name="nombre" required class="form-control"></div>';
    echo '  <div style="flex:1 1 160px;"><label>Email:</label><input type="email" name="email" required class="form-control"></div>';
    echo '  <div style="flex:1 1 120px;"><label>Teléfono:</label><input type="text" name="telefono" required class="form-control"></div>';
    echo '  <div style="flex:1 1 180px;"><label>Dirección:</label><input type="text" name="direccion" class="form-control"></div>';
    // Contraseña igual al teléfono (oculto)
    echo '  <input type="hidden" name="password_auto" value="1">';
    if ($rol === 'empleado') {
        echo '  <div style="flex:1 1 160px;"><label>Especialidad:</label><input type="text" name="especialidad" required class="form-control"></div>';
        echo '  <div style="flex:1 1 160px;"><label>Fecha contratación:</label><input type="date" name="contratacion" required class="form-control"></div>';
    }
    echo '  <button type="submit" class="btn-animado" style="min-width:120px;">Agregar</button>';
    echo '</div>';
    echo '</form>';

    echo '</div>';
}