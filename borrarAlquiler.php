<?php
session_start();
require_once 'config.php';

if (isset($_SESSION['usuario'])) {
    if (isset($_GET['id'])) {
        $alquiler_id = $_GET['id'];
        $usuario_id = $_SESSION['usuario'];

        $query = "SELECT UsuarioID FROM alquileres WHERE ID = $alquiler_id";
        $result = mysqli_query($conexion, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $propietario_alquiler = $row['UsuarioID'];

            if ($propietario_alquiler == $usuario_id) {
                $delete_query = "DELETE FROM alquileres WHERE ID = $alquiler_id";
                $delete_result = mysqli_query($conexion, $delete_query);

                if ($delete_result) {
                    header("Location:index.php");
                    exit();
                } else {
                    echo "Error al eliminar el alquiler: " . mysqli_error($conexion);
                }
            } else {
                echo "No tienes permisos para eliminar este alquiler.";
            }
        } else {
            echo "Error en la consulta: " . mysqli_error($conexion);
        }
    } else {
        echo "ID de alquiler incorrecto.";
    }
} else {
    echo "Debes iniciar sesión para eliminar un alquiler.";
}

mysqli_close($conexion);
?>
