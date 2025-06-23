<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<link rel="stylesheet" href="css/style.css">
<?php if (isset($usuarios) && is_array($usuarios)): ?>
<script>
window.emailsRegistrados = <?= json_encode(array_map('strtolower', array_column($usuarios, 'email'))) ?>;
</script>
<?php endif; ?>
<?php
if (isset($GLOBALS['__extra_js_vars'])):
    foreach ($GLOBALS['__extra_js_vars'] as $var => $val) {
        echo "<script>window.$var = " . json_encode($val) . ";</script>";
    }
endif;
?>
<script src="<?php echo $ruta; ?>views/js/main.js"></script>
</body>
</main>
<footer style="background-color: #ffe494;" class="py-4 mt-5 shadow">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-6 d-flex align-items-center">
                <a href="<?php echo $pagina ?? 'index.php?modulo=login'; ?>">
                    <img src="<?php echo $ruta; ?>img/logo.jpg" alt="Logo" style="max-width: 220px;">
                </a>
                <span class="ms-3 fw-bold" style="color: #222; font-size: 0.8rem;">
                    ©2025 VivaAnimal™. Todos los derechos reservados.
                </span>
            </div>
            <div class="col-6 text-end">
                <a href="https://facebook.com" target="_blank" rel="noopener" class="ms-3">
                    <img src="<?php echo $ruta; ?>img/fb_logo.png" alt="Facebook" style="max-width: 40px;">
                </a>
                <a href="https://instagram.com" target="_blank" rel="noopener" class="ms-3">
                    <img src="<?php echo $ruta; ?>img/ig_logo.png" alt="Instagram" style="max-width: 40px;">
                </a>
                <a href="https://twitter.com" target="_blank" rel="noopener" class="ms-3">
                    <img src="<?php echo $ruta; ?>img/tw_logo.png" alt="Twitter" style="max-width: 40px;">
                </a>
            </div>
        </div>
    </div>
</footer>
<?php
$noBackBtn = [
    'login', 'register', 'homepage', 'adminpage', 'emplepage'
];
$moduloActual = $_GET['modulo'] ?? 'login';
$mostrarBackBtn = !in_array($moduloActual, $noBackBtn);
?>
<?php if ($mostrarBackBtn): ?>
    <button id="btn-volver-atras" style="
        position: fixed;
        right: 32px;
        bottom: 92px;
        z-index: 1001;
        background: #ffe494;
        color: #222;
        border: none;
        border-radius: 50%;
        width: 54px;
        height: 54px;
        box-shadow: 0 2px 12px rgba(230,149,0,0.13);
        font-size: 2rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    " title="Volver">
        ←
    </button>
    <script>
        document.getElementById('btn-volver-atras').onclick = function() {
            window.history.back();
        };
    </script>
<?php endif; ?>
