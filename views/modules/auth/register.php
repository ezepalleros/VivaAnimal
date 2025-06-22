<div class="form-contenedor">
    <h2>Registro de nuevo cliente</h2>
    <form action="index.php?modulo=register" method="POST">
        <label>Nombre:</label>
        <input type="text" name="nombre" required>

        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Teléfono (usado como contraseña):</label>
        <input type="text" name="telefono" required>

        <label>Dirección:</label>
        <input type="text" name="direccion" required>

        <button type="submit">Registrarse</button>
    </form>
    <p class="mt-3 text-center">
        ¿Ya tenés una cuenta? <a href="index.php?modulo=login">Iniciar sesión</a>
    </p>
</div>
