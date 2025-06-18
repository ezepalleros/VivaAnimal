<h2>Registro de nuevo cliente</h2>

<form action="index.php?modulo=register" method="POST">
    <label>Nombre:</label><br>
    <input type="text" name="nombre" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Teléfono (usado como contraseña):</label><br>
    <input type="text" name="telefono" required><br><br>

    <label>Dirección:</label><br>
    <input type="text" name="direccion" required><br><br>

    <button type="submit">Registrarse</button>
</form>

<p>¿Ya tenés una cuenta? <a href="index.php?modulo=login">Iniciar sesión</a></p>
