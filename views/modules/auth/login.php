<div class="form-contenedor">
    <h2>Iniciar sesión</h2>
    <form method="POST" action="index.php?modulo=login">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Teléfono (contraseña):</label>
        <input type="password" name="telefono" required>

        <button type="submit">Ingresar</button>
    </form>
    <p class="mt-3 text-center">
        ¿No tenés cuenta? <a href="index.php?modulo=register">Registrate acá</a>
    </p>
</div>