<?php
session_start();
require_once 'config.php';

$respuesta = $_POST["respuesta"];
$alquiler_id = $_POST["alquiler_id"];
$reseña_id = $_POST["reseña_id"]; 

$sqlActualizarRespuesta = "UPDATE Reseñas SET RespuestaDueño = '$respuesta' WHERE AlquilerID = '$alquiler_id' AND ID = '$reseña_id'";

if (mysqli_query($conexion, $sqlActualizarRespuesta)) {
    echo '<script>';
    echo 'alert("Ya realizó su respuesta con éxito.");';
    echo 'window.location.href = "detalles.php?id=' . $alquiler_id . '";'; 
    echo '</script>';
    exit();
} else {
    echo "Error al guardar la reseña: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
