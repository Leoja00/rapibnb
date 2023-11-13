document.addEventListener("DOMContentLoaded", function() {
    var fechaInicio = "<?php echo $fechaInicio; ?>";
    var fechaHastaInput = document.getElementById("fechaHasta");
    var fechaDesdeInput = document.getElementById("fechaDesde");
    var fechaActual = new Date().toISOString().split('T')[0];

    if (fechaInicio === '0000-00-00' || fechaInicio === null) {
        fechaDesdeInput.setAttribute("min", fechaActual);
        fechaHastaInput.setAttribute("min", fechaActual);
    } else {
        var fechaInicioDate = new Date(fechaInicio);
        if (fechaInicioDate >= new Date()) {
            fechaDesdeInput.setAttribute("min", fechaInicio);
            fechaHastaInput.setAttribute("min", fechaInicio);
        } else {
            fechaDesdeInput.setAttribute("min", fechaActual);
            fechaHastaInput.setAttribute("min", fechaActual);
        }
    }
});

function calcularTotal(costoPorDia, tiempoMinimo, tiempoMaximo, cupo) {
    var cantidadPersonas = document.getElementById('cantidadPersonas').value;
    var diasPermanencia = 0;

    if (document.getElementById('fechaDesde') && document.getElementById('fechaHasta')) {
        var fechaDesde = new Date(document.getElementById('fechaDesde').value);
        var fechaHasta = new Date(document.getElementById('fechaHasta').value);
        var diffTiempo = fechaHasta - fechaDesde;
        diasPermanencia = Math.ceil(diffTiempo / (1000 * 60 * 60 * 24)) + 1;
    } else {
        diasPermanencia = document.getElementById('diasPermanencia').value;
    }

    if (!/^\d+$/.test(cantidadPersonas) || !/^\d+$/.test(diasPermanencia)) {
        alert('Debe completar los campos');
    } else if (diasPermanencia < tiempoMinimo || diasPermanencia > tiempoMaximo) {
        alert('El tiempo de permanencia debe estar entre ' + tiempoMinimo + ' y ' + tiempoMaximo + ' días.');
    } else if (cantidadPersonas > cupo || cantidadPersonas <= 0) {
        alert('La cantidad de personas tiene que estar entre ' + 1 + ' y ' + cupo + ' personas.');
    } else {
        var total = costoPorDia * diasPermanencia;
        document.getElementById('total').innerHTML = 'Total: $' + total;
        var fechaDesde = document.getElementById('fechaDesde').value;
        var fechaHasta = document.getElementById('fechaHasta').value;

        if (fechaDesde && fechaHasta) {
            document.getElementById('formFechaDesde').value = fechaDesde;
            document.getElementById('formFechaHasta').value = fechaHasta;
            document.getElementById('btnReservar').style.display = 'inline-block';
        } else {
            alert('Por favor, selecciona las fechas antes de calcular.');
        }
    }
}

$('#ofertaModal').on('hidden.bs.modal', function () {
    document.getElementById('cantidadPersonas').value = '';
    document.getElementById('diasPermanencia').value = '';
    document.getElementById('fechaDesde').value = '';
    document.getElementById('fechaHasta').value = '';
    document.getElementById('total').innerHTML = '';
    document.getElementById('btnReservar').style.display = 'none';
});
