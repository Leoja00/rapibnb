<?php
session_start();
require_once 'config.php';

$usuario_id = $_SESSION['usuario'];
$alquiler_id = $_GET['id'];
$reserva_id = $_GET['reserva_id']; 


$borrar = "DELETE FROM reservas WHERE AlquilerID = $alquiler_id AND ID = $reserva_id";
$resultadoBorrar = mysqli_query($conexion, $borrar);

if ($resultadoBorrar) {
    echo '<script>';
    echo 'alert("Oferta rechazada correctamente.");';
    echo 'window.location.href = "detalles.php?id=' . $alquiler_id . '";'; 
    echo '</script>';
    exit();
} else {
    echo '<p>Error al eliminar la oferta</p>';
}

mysqli_close($conexion);
?>
