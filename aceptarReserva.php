<?php
session_start();
require_once 'config.php';

$usuario_id = $_SESSION['usuario'];
$alquiler_id = $_GET['id'];
$reserva_id = $_GET['reserva_id']; 


$aceptar = "UPDATE reservas SET Estado = 'Reservado' WHERE AlquilerID = $alquiler_id AND ID = $reserva_id";
$resultadoAceptar = mysqli_query($conexion, $aceptar);


if ($resultadoAceptar) {
    echo '<script>';
    echo 'alert("Reserva aceptada correctamente.");';
    echo 'window.location.href = "detalles.php?id=' . $alquiler_id . '";'; 
    echo '</script>';
    exit();
} else {
    echo '<p>Error al actualizar la reserva</p>';
}

mysqli_close($conexion);
?>
