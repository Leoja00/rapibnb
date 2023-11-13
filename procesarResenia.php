<?php
session_start();
require_once 'config.php';

$usuario_id = $_POST["usuario_id"];
$alquiler_id = $_POST["alquiler_id"];
$reserva_id = $_POST["reserva_id"];
$resena = $_POST["resena"];
$puntuacion = $_POST["puntuacion"];

$sqlInsertarResena = "INSERT INTO reseñas (Comentario, Puntaje, AlquilerID, UsuarioID, ReservaID) 
                      VALUES ('$resena', '$puntuacion', '$alquiler_id', '$usuario_id', '$reserva_id')";


if (mysqli_query($conexion, $sqlInsertarResena)) {
    echo '<script>';
    echo 'alert("Ya realizó su reseña con éxito\n ¡Espero que la haya pasado excelente!");';
    echo 'window.location.href = "detalles.php?id=' . $alquiler_id . '";'; 
    echo '</script>';
    exit();
} else {
    echo "Error al guardar la reseña: " . mysqli_error($conexion);
}

mysqli_close($conexion);
?>
