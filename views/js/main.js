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

    // Validación rápida de email duplicado en formularios de usuario (opcional, requiere lista de emails)
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

    // Validación avanzada para el formulario de agregar animal (admin)
    const formAnimal = document.getElementById('form-agregar-animal');
    if (formAnimal) {
        // Obtener IDs de usuarios válidos si están disponibles en window
        const usuariosValidos = window.usuariosValidos || [];

        formAnimal.addEventListener('submit', function(e) {
            const nombre = formAnimal.nombre.value.trim();
            const edad = parseInt(formAnimal.edad.value, 10);
            const especie = formAnimal.especie.value.trim();
            const raza = formAnimal.raza.value.trim();
            const id_usuario = formAnimal.id_usuario.value.trim();

            // Validaciones
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

    // Validación para editar animal (admin)
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

    // Validación para editar usuario (admin)
    const formEditarUsuario = document.querySelector('form[action="index.php?modulo=editar_usuario"]');
    if (formEditarUsuario) {
        const emailInput = formEditarUsuario.email;
        const usuarioOriginalEmail = emailInput ? emailInput.value.trim().toLowerCase() : "";
        const telefonoInput = formEditarUsuario.telefono;
        const usuarioOriginalTelefono = telefonoInput ? telefonoInput.value.trim() : "";
        const telefonosRegistrados = window.telefonosRegistrados || [];

        formEditarUsuario.addEventListener('submit', function(e) {
            const nombre = formEditarUsuario.nombre.value.trim();
            const telefono = formEditarUsuario.telefono.value.trim();
            const direccion = formEditarUsuario.direccion.value.trim();
            const rol = formEditarUsuario.rol.value;
            const especialidadInput = formEditarUsuario.querySelector('[name="especialidad"]');
            let especialidad = "";
            if (especialidadInput) {
                especialidad = especialidadInput.value.trim();
            }
            const email = emailInput.value.trim().toLowerCase();

            // Nombre: más de 3 letras
            if (nombre.length < 4) {
                alert("El nombre debe tener al menos 4 letras.");
                formEditarUsuario.nombre.focus();
                e.preventDefault();
                return;
            }
            // Teléfono: exactamente 10 números
            if (!/^\d{10}$/.test(telefono)) {
                alert("El teléfono debe tener exactamente 10 números.");
                formEditarUsuario.telefono.focus();
                e.preventDefault();
                return;
            }
            // Dirección: más de 5 letras
            if (direccion.length < 6) {
                alert("La dirección debe tener al menos 6 caracteres.");
                formEditarUsuario.direccion.focus();
                e.preventDefault();
                return;
            }
            // Especialidad: si es empleado, más de 5 letras
            if (rol === "empleado" && especialidadInput && especialidad.length < 6) {
                alert("La especialidad debe tener al menos 6 caracteres.");
                especialidadInput.focus();
                e.preventDefault();
                return;
            }
            // Email no repetido (excepto el propio)
            if (emailsRegistrados.includes(email) && email !== usuarioOriginalEmail) {
                alert("El email ya está registrado por otro usuario.");
                emailInput.focus();
                e.preventDefault();
                return;
            }
            // Teléfono no repetido (excepto el propio)
            if (telefonosRegistrados.includes(telefono) && telefono !== usuarioOriginalTelefono) {
                alert("El teléfono ya está registrado por otro usuario.");
                telefonoInput.focus();
                e.preventDefault();
                return;
            }
        });
    }

    // Validación para registro de cliente
    const formRegister = document.querySelector('form[action="index.php?modulo=register"]');
    if (formRegister) {
        const emailsRegistrados = window.emailsRegistrados || [];
        const telefonosRegistrados = window.telefonosRegistrados || [];
        formRegister.addEventListener('submit', function(e) {
            const nombre = formRegister.nombre.value.trim();
            const telefono = formRegister.telefono.value.trim();
            const direccion = formRegister.direccion.value.trim();
            const email = formRegister.email.value.trim().toLowerCase();

            // Nombre: más de 3 letras
            if (nombre.length < 4) {
                alert("El nombre debe tener al menos 4 letras.");
                formRegister.nombre.focus();
                e.preventDefault();
                return;
            }
            // Teléfono: exactamente 10 números
            if (!/^\d{10}$/.test(telefono)) {
                alert("El teléfono debe tener exactamente 10 números.");
                formRegister.telefono.focus();
                e.preventDefault();
                return;
            }
            // Dirección: más de 5 letras
            if (direccion.length < 6) {
                alert("La dirección debe tener al menos 6 caracteres.");
                formRegister.direccion.focus();
                e.preventDefault();
                return;
            }
            // Email no repetido
            if (emailsRegistrados.includes(email)) {
                alert("El email ya está registrado por otro usuario.");
                formRegister.email.focus();
                e.preventDefault();
                return;
            }
            // Teléfono no repetido
            if (telefonosRegistrados.includes(telefono)) {
                alert("El teléfono ya está registrado por otro usuario.");
                formRegister.telefono.focus();
                e.preventDefault();
                return;
            }
        });
    }

    // Validación para editar consulta (admin)
    const formEditarConsulta = document.getElementById('form-editar-consulta');
    if (formEditarConsulta) {
        formEditarConsulta.addEventListener('submit', function(e) {
            const descripcion = formEditarConsulta.descripcion.value.trim();
            const fecha = formEditarConsulta.fecha.value;
            const hoy = new Date();
            const fechaSeleccionada = new Date(fecha + "T00:00:00");

            // Descripción: más de 5 letras
            if (descripcion.length < 6) {
                alert("La descripción debe tener al menos 6 caracteres.");
                formEditarConsulta.descripcion.focus();
                e.preventDefault();
                return;
            }
            // Fecha: debe ser futura
            hoy.setHours(0,0,0,0);
            if (fechaSeleccionada <= hoy) {
                alert("La fecha debe ser futura.");
                formEditarConsulta.fecha.focus();
                e.preventDefault();
                return;
            }
        });
    }

    // Validación para crear consulta (admin y cliente)
    // Admin: admin_consultas.php
    const formCrearConsultaAdmin = document.querySelector('form[action="index.php?modulo=admin_consultas"]');
    if (formCrearConsultaAdmin) {
        formCrearConsultaAdmin.addEventListener('submit', function(e) {
            const descripcion = formCrearConsultaAdmin.descripcion.value.trim();
            const fecha = formCrearConsultaAdmin.fecha.value;
            const hoy = new Date();
            const fechaSeleccionada = new Date(fecha + "T00:00:00");

            // Descripción: más de 5 letras
            if (descripcion.length < 6) {
                alert("La descripción debe tener al menos 6 caracteres.");
                formCrearConsultaAdmin.descripcion.focus();
                e.preventDefault();
                return;
            }
            // Fecha: debe ser futura
            hoy.setHours(0,0,0,0);
            if (fechaSeleccionada <= hoy) {
                alert("La fecha debe ser futura.");
                formCrearConsultaAdmin.fecha.focus();
                e.preventDefault();
                return;
            }
        });
    }

    // Cliente: hacer_consulta.php
    const formCrearConsultaCliente = document.querySelector('form[action="index.php?modulo=guardar_consulta"]');
    if (formCrearConsultaCliente) {
        formCrearConsultaCliente.addEventListener('submit', function(e) {
            const descripcion = formCrearConsultaCliente.descripcion.value.trim();
            const fecha = formCrearConsultaCliente.fecha.value;
            const hoy = new Date();
            const fechaSeleccionada = new Date(fecha + "T00:00:00");

            // Descripción: más de 5 letras
            if (descripcion.length < 6) {
                alert("La descripción debe tener al menos 6 caracteres.");
                formCrearConsultaCliente.descripcion.focus();
                e.preventDefault();
                return;
            }
            // Fecha: debe ser futura
            hoy.setHours(0,0,0,0);
            if (fechaSeleccionada <= hoy) {
                alert("La fecha debe ser futura.");
                formCrearConsultaCliente.fecha.focus();
                e.preventDefault();
                return;
            }
        });
    }

    // Validación para agregar o editar animal (cliente)
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

    // Validación para editar especialidad (empleado)
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
