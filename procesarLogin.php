<?php
session_start();
require_once 'config.php';


    $correo = $_POST["correo"];
    $contraseña = $_POST["contrasenia"];
    $sql = "SELECT id, contraseña FROM usuarios WHERE correoElectronico = ?";
    
    if ($stmt = mysqli_prepare($conexion, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $correo);
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);
            if ($result->num_rows == 1) {
                $row = mysqli_fetch_assoc($result);
                if (password_verify($contraseña, $row["contraseña"])) {
                    $_SESSION["usuario"] = $row["id"];
                    header("Location: index.php");
                    
                    exit();
                }
            }
        }
    }
    header("Location: login.php?error=1");
    exit();


mysqli_close($conexion);
?>
