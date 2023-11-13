document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        const titulo = document.querySelector('[name="titulo"]').value;
        const descripcion = document.querySelector('[name="descripcion"]').value;
        const ubicacion = document.querySelector('[name="ubicacion"]').value;
        const etiquetas = document.querySelector('[name="etiquetas"]').value;
        const costoPorDia = parseFloat(document.querySelector('[name="costo_por_dia"]').value);
        const tiempoMinimo = parseInt(document.querySelector('[name="tiempo_minimo"]').value);
        const tiempoMaximo = parseInt(document.querySelector('[name="tiempo_maximo"]').value);
        const cupos = parseInt(document.querySelector('[name="cupos"]').value);

        const servicios = Array.from(document.querySelector('[name="servicios[]"]').selectedOptions).map(option => option.value);

        const soloLetrasRegex = /^[A-Za-z\s]+$/;


        if (!soloLetrasRegex.test(titulo)) {
            mostrarAlerta('error', 'Titulo invalido', 'Por favor, ingrese letras, no numeros.');
            return;
        }

        if (tiempoMinimo < 1) {
            mostrarAlerta('error', 'Tiempo minimo invalido', 'La permanencia minima es de un día.');
            return;
        }
        if (cupos < 1 || cupos >20) {
            mostrarAlerta('error', 'Cupo de personas invalido', 'La cantidad es entre 1 y 20 personas.');
            return;
        }

        if (tiempoMaximo < tiempoMinimo) {
            mostrarAlerta('error', 'Tiempo maximo invalido', 'La permanencia maxima no puede ser menor que la minima.');
            return;
        }

        if (costoPorDia < 1000) {
            mostrarAlerta('error', 'Costo por día inválido', 'El costo por día debe ser igual o mayor a 1000.');
            return;
        }

        fetch('procesarAnuncio.php', {
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
            mostrarAlerta('error', 'Error', 'Hubo un problema al procesar la solicitud.');
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
