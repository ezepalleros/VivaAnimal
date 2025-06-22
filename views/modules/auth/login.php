<div class="container" style="max-width: 400px;">
    <h2 class="mb-4 text-center">Iniciar sesión</h2>
    <form method="POST" action="index.php?modulo=login">
        <label>Email:</label><br>
        <input type="email" name="email" class="form-control mb-3" required>

        <label>Teléfono (contraseña):</label><br>
        <input type="password" name="telefono" class="form-control mb-3" required>

        <button type="submit" class="btn btn-warning w-100">Ingresar</button>
    </form>

    <p class="mt-3 text-center">¿No tenés cuenta? <a href="index.php?modulo=register">Registrate acá</a></p>
</div>