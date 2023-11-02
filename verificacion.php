<?php
session_start();
require_once 'config.php';

if (isset($_SESSION["usuario"])) {
    $idUsuario = $_SESSION['usuario'];
    $mensaje = mysqli_real_escape_string($conexion, $_POST['mensaje']);
    if ($_FILES['archivo']['error'] == 0) {
        $archivoNombre = $_FILES['archivo']['name'];
        $archivoTmpName = $_FILES['archivo']['tmp_name'];
        $archivoPath = "archivosVerificar/" . $archivoNombre; 
        move_uploaded_file($archivoTmpName, $archivoPath);

    }

    $query = "UPDATE usuarios SET MensajeVerificacion = '$mensaje', archivoVerificacion = '$archivoPath' WHERE id = $idUsuario";
    mysqli_query($conexion, $query);

    header("Location: perfil.php");
    exit();
}
?>
