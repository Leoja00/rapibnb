<?php
session_start();
require_once 'header.php';

    if (isset($_POST['userID'])) {
        $userID = $_POST['userID'];
        
        $fechaVerificacion = date('Y-m-d H:i:s');
        $fechaVencimiento = $_POST['fechaVencimiento'];
        $sql = "UPDATE usuarios SET Verificado = 1, FechaVerificacion = '$fechaVerificacion', FechaVencimiento = '$fechaVencimiento' WHERE ID = $userID";
        if ($conexion->query($sql) === TRUE) {
            $sqlUpdateAlquileres = "UPDATE alquileres SET FechaVisible = NULL WHERE UsuarioID = $userID";
            if ($conexion->query($sqlUpdateAlquileres) === TRUE) {
                echo '<script>';
                echo 'alert("Usuario ya verificado");';
                echo 'window.location.href = "panelAdmin.php";';
                echo '</script>';
                exit();
            } else {
                echo "Error al actualizar alquileres: " . $conexion->error;
            }
        } else {
            echo "Error al verificar usuario: " . $conexion->error;
        }
    } else {
        echo "No se proporcionó un ID de usuario.";
    }
require_once 'footer.php';
?>

