<?php
session_start();
require_once 'config.php';

if (isset($_SESSION["usuario"])) {
    $idUsuario = $_SESSION['usuario'];

    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $apellido = mysqli_real_escape_string($conexion, $_POST['apellido']);
    $dni = mysqli_real_escape_string($conexion, $_POST['dni']);
    $correo = mysqli_real_escape_string($conexion, $_POST['correo']);
    $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
    $intereses = mysqli_real_escape_string($conexion, $_POST['intereses']);
    $biografia = mysqli_real_escape_string($conexion, $_POST['biografia']);
    
    // 
    if ($_FILES['avatar']['error'] == 0) {
        $avatarNombre = $_FILES['avatar']['name'];
        $avatarTmpName = $_FILES['avatar']['tmp_name'];
        $avatarPath = "imgUser/" . $avatarNombre; 
        move_uploaded_file($avatarTmpName, $avatarPath);
        
        $query = "UPDATE usuarios SET avatar = '$avatarPath' WHERE id = $idUsuario";
        mysqli_query($conexion, $query);
    }
    
   
    $query = "UPDATE usuarios SET nombre = '$nombre', apellido = '$apellido', dni = '$dni', correoElectronico = '$correo', telefono = '$telefono', intereses = '$intereses', biografia = '$biografia' WHERE id = $idUsuario";
    mysqli_query($conexion, $query);
    

    header("Location: perfil.php");
    exit();
}
