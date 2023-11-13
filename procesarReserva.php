<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['usuario']) && isset($_GET['id'])) {
    $usuario_id = $_SESSION['usuario'];
    $alquiler_id = $_GET['id'];
    $fechaDesde = $_POST['fechaDesde'];
    $fechaHasta = $_POST['fechaHasta'];
    $fechaCreacion = date('Y-m-d H:i:s');
    $estado = 'Reservado';

    $sqlVerificacion = "SELECT Verificado FROM usuarios WHERE ID = '$usuario_id'";
    $resultVerificacion = mysqli_query($conexion, $sqlVerificacion);

    if ($resultVerificacion) {
        $row = mysqli_fetch_assoc($resultVerificacion);
        $usuarioVerificado = $row['Verificado'];
        //VERIFICADO
        if ($usuarioVerificado == 1) {
            $sqlReserva = "INSERT INTO reservas (UsuarioID, AlquilerID, FechaReservaInicio, FechaReservaFin, FechaCreacion, Estado)
                           VALUES ('$usuario_id', '$alquiler_id', '$fechaDesde', '$fechaHasta', '$fechaCreacion', '$estado')";
            $resultReserva = mysqli_query($conexion, $sqlReserva);
            if ($resultReserva) {
                echo '<script>';
                echo 'alert("Ya realizó su reserva correctamente.\n¡Disfrute de la estadía!");';
                echo 'window.location.href = "detalles.php?id=' . $alquiler_id . '";'; 
                echo '</script>';
                exit();
            } else {
                echo "Error al procesar la reserva: " . mysqli_error($conexion);
            }

            //NO VERIFICADO
        } else {
            $sqlReservaExistente = "SELECT COUNT(*) as totalReservas FROM reservas WHERE UsuarioID = '$usuario_id' AND Estado IN ('En revision', 'Activa')";
            $resultReservaExistente = mysqli_query($conexion, $sqlReservaExistente);

            if ($resultReservaExistente) {
                $rowReservaExistente = mysqli_fetch_assoc($resultReservaExistente);
                $totalReservas = $rowReservaExistente['totalReservas'];

                //TIENE RESERVAS ACTIVAS O EN REVISION
                if ($totalReservas > 0) {
                    echo '<script>';
                    echo 'alert("Ya tiene una reserva activa o en revisión. No se permite realizar más reservas.");';
                    echo 'window.location.href = "detalles.php?id=' . $alquiler_id . '";'; 
                    echo '</script>';
                    exit();
                } else {
                    $estado = "En revision";
                    $sqlReserva = "INSERT INTO reservas (UsuarioID, AlquilerID, FechaReservaInicio, FechaReservaFin, FechaCreacion, Estado)
                                   VALUES ('$usuario_id', '$alquiler_id', '$fechaDesde', '$fechaHasta', '$fechaCreacion', '$estado')";
                    $resultReserva = mysqli_query($conexion, $sqlReserva);
                    if ($resultReserva) {
                        echo '<script>';
                        echo 'alert("Ya realizó su reserva\n¡Proximamente sera revisada!");';
                        echo 'window.location.href = "detalles.php?id=' . $alquiler_id . '";'; 
                        echo '</script>';
                        exit();
                    } else {
                        echo "Error al procesar la reserva: " . mysqli_error($conexion);
                    }
                }
            } else {
                echo "Error al verificar reservas existentes: " . mysqli_error($conexion);
            }
        }
    } else {
        echo "Error al verificar el estado de verificación del usuario: " . mysqli_error($conexion);
    }

} else {
    echo "Error: Usuario no autenticado o ID de alquiler no proporcionado.";
}

mysqli_close($conexion);
?>
