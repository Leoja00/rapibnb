document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const dniRegex = /^\d{8}$/;
        const dni = document.querySelector('#dni').value;

        if (!dniRegex.test(dni)) {

            alert('Formato de DNI incorrecto. Por favor, ingresa un DNI válido de 8 caracteres alfanuméricos.');
            return;
        }

        Swal.fire({
            title: '¿Estás seguro?',
            text: 'Se guardarán los cambios en tu perfil.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, guardar cambios',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
});
