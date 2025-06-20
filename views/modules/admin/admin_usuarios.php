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
?>

<h2>Usuarios por Rol</h2>

<?php foreach ($usuarios_por_rol as $rol => $lista_usuarios): ?>
    <h3><?= ucfirst($rol) ?>s</h3>
    <?php if (count($lista_usuarios) > 0): ?>
        <table border="1" cellpadding="4" cellspacing="0" style="margin-bottom: 20px; width: 80%; font-size: 14px;">
            <thead>
                <tr>
                    <th style="padding: 4px 8px;">ID</th>
                    <th style="padding: 4px 8px;">Nombre</th>
                    <th style="padding: 4px 8px;">Email</th>
                    <th style="padding: 4px 8px;">Teléfono</th>
                    <th style="padding: 4px 8px;">Dirección</th>
                    <?php if ($rol === 'empleado'): ?>
                        <th style="padding: 4px 8px;">Especialidad</th>
                        <th style="padding: 4px 8px;">Fecha Contratación</th>
                    <?php endif; ?>
                    <th style="padding: 4px 8px;">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lista_usuarios as $u): ?>
                    <tr>
                        <td style="padding: 4px 8px;"><?= htmlspecialchars($u['id_usu']) ?></td>
                        <td style="padding: 4px 8px;"><?= htmlspecialchars($u['nombre']) ?></td>
                        <td style="padding: 4px 8px;"><?= htmlspecialchars($u['email']) ?></td>
                        <td style="padding: 4px 8px;"><?= htmlspecialchars($u['telefono']) ?></td>
                        <td style="padding: 4px 8px;"><?= htmlspecialchars($u['direccion']) ?></td>
                        <?php if ($rol === 'empleado'): ?>
                            <td style="padding: 4px 8px;"><?= htmlspecialchars($u['especialidad'] ?? '') ?></td>
                            <td style="padding: 4px 8px;"><?= htmlspecialchars($u['contratacion'] ?? '') ?></td>
                        <?php endif; ?>
                        <td style="padding: 4px 8px;">
                            <a href="index.php?modulo=editar_usuario&id=<?= urlencode($u['id_usu']) ?>">Editar</a> |
                            <form action="index.php?modulo=eliminar_usuario" method="POST" style="display:inline; margin: 0; padding: 0;">
                                <input type="hidden" name="id_usu" value="<?= htmlspecialchars($u['id_usu']) ?>">
                                <button type="submit" onclick="return confirm('¿Eliminar este usuario?')" style="background:none; border:none; color:blue; cursor:pointer; text-decoration:underline; padding:0; font-size:14px;">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay usuarios con rol <?= htmlspecialchars($rol) ?>.</p>
    <?php endif; ?>
<?php endforeach; ?>


<p><a href="index.php?modulo=adminpage">← Volver al panel de administración</a></p>
