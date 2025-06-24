document.addEventListener("DOMContentLoaded", function() {
    const emojis = ["🐶", "🐱", "🐾", "🐰", "🦴", "🐦", "🐢", "🐕", "🐈"];
    const emojiBg = document.getElementById("emoji-bg");
    const emojiCount = 36;

    function randomBetween(a, b) {
        return Math.random() * (b - a) + a;
    }

    for (let i = 0; i < emojiCount; i++) {
        const span = document.createElement("span");
        span.className = "emoji-float";
        span.textContent = emojis[Math.floor(Math.random() * emojis.length)];
        span.style.top = randomBetween(0, 90) + "vh";
        span.style.left = "-8vw";
        span.style.fontSize = randomBetween(3, 5.5) + "rem";
        span.style.opacity = randomBetween(0.1, 0.6);
        emojiBg.appendChild(span);

        const duration = randomBetween(12, 28);
        span.animate([
            { transform: `translateX(0vw)` },
            { transform: `translateX(116vw)` }
        ], {
            duration: duration * 1000,
            iterations: Infinity,
            delay: randomBetween(0, 10000)
        });
    }

    document.querySelectorAll('.btn-animado').forEach(btn => {
        if (!btn.closest('.dropdown-menu')) {
            btn.addEventListener('click', function(e) {
                if (btn.tagName === 'A') {
                    e.preventDefault();
                    btn.classList.add('clicked');
                    setTimeout(() => {
                        btn.classList.remove('clicked');
                        window.location.href = btn.href;
                    }, 220);
                }
            });
        }
    });

    const emailsRegistrados = window.emailsRegistrados || [];
    document.querySelectorAll('form input[type="email"]').forEach(function(input) {
        input.addEventListener('blur', function() {
            const email = input.value.trim().toLowerCase();
            if (emailsRegistrados.includes(email)) {
                alert('El email ya está registrado. Por favor, usa otro.');
                input.focus();
            }
        });
    });

    const formAnimal = document.getElementById('form-agregar-animal');
    if (formAnimal) {
        const usuariosValidos = window.usuariosValidos || [];
        formAnimal.addEventListener('submit', function(e) {
            const nombre = formAnimal.nombre.value.trim();
            const edad = parseInt(formAnimal.edad.value, 10);
            const especie = formAnimal.especie.value.trim();
            const raza = formAnimal.raza.value.trim();
            const id_usuario = formAnimal.id_usuario.value.trim();

            if (nombre.length < 3) {
                alert("El nombre debe tener al menos 3 letras.");
                formAnimal.nombre.focus();
                e.preventDefault();
                return;
            }
            if (isNaN(edad) || edad <= 0 || edad >= 30) {
                alert("La edad debe ser mayor a 0 y menor que 30.");
                formAnimal.edad.focus();
                e.preventDefault();
                return;
            }
            if (especie.length < 4) {
                alert("La especie debe tener al menos 4 letras.");
                formAnimal.especie.focus();
                e.preventDefault();
                return;
            }
            if (raza.length < 4) {
                alert("La raza debe tener al menos 4 letras.");
                formAnimal.raza.focus();
                e.preventDefault();
                return;
            }
            if (usuariosValidos.length > 0 && !usuariosValidos.includes(id_usuario)) {
                alert("El ID de dueño no existe.");
                formAnimal.id_usuario.focus();
                e.preventDefault();
                return;
            }
        });
    }

    const formEditarAnimal = document.getElementById('form-editar-animal');
    if (formEditarAnimal) {
        const usuariosValidos = window.usuariosValidos || [];
        formEditarAnimal.addEventListener('submit', function(e) {
            const nombre = formEditarAnimal.nombre.value.trim();
            const edad = parseInt(formEditarAnimal.edad.value, 10);
            const especie = formEditarAnimal.especie.value.trim();
            const raza = formEditarAnimal.raza.value.trim();
            const id_usuario = formEditarAnimal.id_usuario.value.trim();

            if (nombre.length < 3) {
                alert("El nombre debe tener al menos 3 letras.");
                formEditarAnimal.nombre.focus();
                e.preventDefault();
                return;
            }
            if (isNaN(edad) || edad <= 0 || edad >= 30) {
                alert("La edad debe ser mayor a 0 y menor que 30.");
                formEditarAnimal.edad.focus();
                e.preventDefault();
                return;
            }
            if (especie.length < 4) {
                alert("La especie debe tener al menos 4 letras.");
                formEditarAnimal.especie.focus();
                e.preventDefault();
                return;
            }
            if (raza.length < 4) {
                alert("La raza debe tener al menos 4 letras.");
                formEditarAnimal.raza.focus();
                e.preventDefault();
                return;
            }
            if (usuariosValidos.length > 0 && !usuariosValidos.includes(id_usuario)) {
                alert("El ID de dueño no existe.");
                formEditarAnimal.id_usuario.focus();
                e.preventDefault();
                return;
            }
        });
    }

    const formAnimalCliente = document.querySelector('form[action="index.php?modulo=guardar_animal"], form[action="index.php?modulo=editar_animal"]');
    if (formAnimalCliente) {
        formAnimalCliente.addEventListener('submit', function(e) {
            const nombre = formAnimalCliente.nombre.value.trim();
            const edad = parseInt(formAnimalCliente.edad.value, 10);
            const especie = formAnimalCliente.especie.value.trim();
            const raza = formAnimalCliente.raza.value.trim();

            if (nombre.length < 3) {
                alert("El nombre debe tener al menos 3 letras.");
                formAnimalCliente.nombre.focus();
                e.preventDefault();
                return;
            }
            if (isNaN(edad) || edad <= 0 || edad >= 30) {
                alert("La edad debe ser mayor a 0 y menor que 30.");
                formAnimalCliente.edad.focus();
                e.preventDefault();
                return;
            }
            if (especie.length < 4) {
                alert("La especie debe tener al menos 4 letras.");
                formAnimalCliente.especie.focus();
                e.preventDefault();
                return;
            }
            if (raza.length < 4) {
                alert("La raza debe tener al menos 4 letras.");
                formAnimalCliente.raza.focus();
                e.preventDefault();
                return;
            }
        });
    }

    const formEditarEspecialidad = document.querySelector('form[action="index.php?modulo=emp_especialidad"]');
    if (formEditarEspecialidad) {
        formEditarEspecialidad.addEventListener('submit', function(e) {
            const especialidad = formEditarEspecialidad.especialidad.value.trim();
            if (especialidad.length < 6) {
                alert("La especialidad debe tener al menos 6 caracteres.");
                formEditarEspecialidad.especialidad.focus();
                e.preventDefault();
                return;
            }
        });
    }
});
