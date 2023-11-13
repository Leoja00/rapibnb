document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const nombre = document.querySelector('[name="nombre"]').value;
        const correo = document.querySelector('[name="correo"]').value;
        const dni = document.querySelector('[name="dni"]').value;
        const contrasenia = document.querySelector('[name="contrasenia"]').value;
        const confirmarContrasenia = document.querySelector('[name="confirmar_contrasenia"]').value;

        const correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        const dniRegex = /^\d{8}$/; 

        if (!correoRegex.test(correo)) {
            mostrarAlerta('error', 'Formato de correo incorrecto', 'Por favor, ingresa un correo electrónico válido.');
            return;
        }

        if (!dniRegex.test(dni)) {
            mostrarAlerta('error', 'Formato de DNI incorrecto', 'Por favor, ingresa un DNI válido de 8 dígitos.');
            return;
        }

        if (contrasenia !== confirmarContrasenia) {
            mostrarAlerta('error', 'Contraseñas no coinciden', 'Por favor, asegúrate de que las contraseñas coincidan.');
            return;
        }

        fetch('procesarRegistro.php', {
            method: 'POST',
            body: new FormData(form),
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'error') {
                mostrarAlerta('error', 'Error', data.message);
            } else {
                window.location.href = 'index.php';
            }
        })
        .catch(error => {
            console.error('Error al procesar la solicitud:', error);
            mostrarAlerta('error', 'Error', 'Correo/DNI ya registrado.');
        });
    });

    function mostrarAlerta(icon, title, text) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
        });
    }
});
