<?php

require_once 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {//CAMBIAR
    
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $dni = $_POST["dni"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $contrasenia = $_POST["contrasenia"];
    $intereses = $_POST["intereses"];
    $biografia = $_POST["biografia"];
    $hashContrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
    $verificado='no';
    $rol='no';
    $targetDirectory = "imgUser/"; 
    $foto = $targetDirectory . basename($_FILES["foto"]["name"]);

    if (move_uploaded_file($_FILES["foto"]["tmp_name"], $foto)) {
        $sql = "INSERT INTO usuarios (nombre, apellido, dni, correoElectronico, telefono, intereses, avatar,verificado, biografia,rol, contraseña) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssssssss", $nombre, $apellido, $dni, $correo, $telefono, $intereses, $foto,$verificado, $biografia,$rol, $hashContrasenia);
            if (mysqli_stmt_execute($stmt)) {
                session_start();
                $_SESSION["usuario"] = mysqli_insert_id($conexion);
                header("Location: index.php"); 
                exit();
            } else {
                echo "Error al registrar el usuario: " . mysqli_error($conexion);
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
        }
    } else {
        echo "Error al cargar la imagen.";
    }
}

mysqli_close($conexion);
?>
