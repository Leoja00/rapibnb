<?php
session_start();
require_once 'config.php';

$usuarioID = $_SESSION["usuario"];
$query = "SELECT Verificado FROM usuarios WHERE ID = ?";
if ($stmt = mysqli_prepare($conexion, $query)) {
    mysqli_stmt_bind_param($stmt, "i", $usuarioID);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $verificado);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);
} else {
    echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
}

if ($verificado == 1) {
        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];
        $ubicacion = $_POST["ubicacion"];
        $etiquetas = $_POST["etiquetas"];
        $costo_por_dia = $_POST["costo_por_dia"];
        $tiempo_minimo = $_POST["tiempo_minimo"];
        $tiempo_maximo = $_POST["tiempo_maximo"];
        $cupos = $_POST["cupos"];
        $fechaPublicacion = date("Y-m-d H:i:s");

        // Modificación para separar etiquetas
        $etiquetas_array = explode(" ", $etiquetas);
        $etiquetas = "#" . implode(" #", $etiquetas_array);

        $targetDirectory = "imgAlquiler/";
        $galeria_fotos = array();
        foreach ($_FILES["fotos"]["tmp_name"] as $i => $tmp_name) {
            $foto = $targetDirectory . basename($_FILES["fotos"]["name"][$i]);
            if (move_uploaded_file($tmp_name, $foto)) {
                $galeria_fotos[] = $foto;
            }
        }

        $servicios = isset($_POST["servicios"]) ? implode(",", $_POST["servicios"]) : "";

        $sql = "INSERT INTO alquileres (Titulo, Descripcion, Ubicacion, Etiquetas, GaleriaFotos, ListadoServicios, CostoAlquilerPorDia, TiempoMinimoPermanencia, TiempoMaximoPermanencia, Cupo, FechaInicio, FechaFin, UsuarioID, FechaPublicacion) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            $usuarioID = $_SESSION["usuario"];

            mysqli_stmt_bind_param($stmt,"ssssssssssssss",$titulo, $descripcion, $ubicacion,$etiquetas,implode(",", $galeria_fotos),$servicios,$costo_por_dia,$tiempo_minimo,$tiempo_maximo,$cupos,$fechaInicio,$fechaFin,$usuarioID,$fechaPublicacion);

            if (mysqli_stmt_execute($stmt)) {
                header("Location: index.php");
                exit();
            } else {
                echo "Error al registrar el alquiler: " . mysqli_error($conexion);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
        }
    
} elseIF($verificado==0){
    $queryPublicaciones = "SELECT COUNT(*) FROM alquileres WHERE UsuarioID = ?";
if ($stmtPublicaciones = mysqli_prepare($conexion, $queryPublicaciones)) {
    mysqli_stmt_bind_param($stmtPublicaciones, "i", $usuarioID);
    mysqli_stmt_execute($stmtPublicaciones);
    mysqli_stmt_bind_result($stmtPublicaciones, $numPublicaciones);
    mysqli_stmt_fetch($stmtPublicaciones);
    mysqli_stmt_close($stmtPublicaciones);


    if ($numPublicaciones > 0) {
        echo "<script>alert('Es un usuario regular, ya tiene una publicación.');";
        echo "window.location.href='index.php';</script>";
        exit();
    } else {
        $fechaPublicacion = date("Y-m-d H:i:s");
        $fechaVisible = date("Y-m-d H:i:s", strtotime($fechaPublicacion . " +5 days"));
        $titulo = $_POST["titulo"];
        $descripcion = $_POST["descripcion"];
        $ubicacion = $_POST["ubicacion"];
        $etiquetas = $_POST["etiquetas"];
        $costo_por_dia = $_POST["costo_por_dia"];
        $tiempo_minimo = $_POST["tiempo_minimo"];
        $tiempo_maximo = $_POST["tiempo_maximo"];
        $cupos = $_POST["cupos"];
        $fechaPublicacion = date("Y-m-d H:i:s");

        $etiquetas_array = explode(" ", $etiquetas);
        $etiquetas = "#" . implode(" #", $etiquetas_array);

        $targetDirectory = "imgAlquiler/";
        $galeria_fotos = array();
        foreach ($_FILES["fotos"]["tmp_name"] as $i => $tmp_name) {
            $foto = $targetDirectory . basename($_FILES["fotos"]["name"][$i]);
            if (move_uploaded_file($tmp_name, $foto)) {
                $galeria_fotos[] = $foto;
            }
        }

        $servicios = isset($_POST["servicios"]) ? implode(",", $_POST["servicios"]) : "";

        $sql = "INSERT INTO alquileres (Titulo, Descripcion, Ubicacion, Etiquetas, GaleriaFotos, ListadoServicios, CostoAlquilerPorDia, TiempoMinimoPermanencia, TiempoMaximoPermanencia, Cupo, FechaInicio, FechaFin, UsuarioID, FechaPublicacion, FechaVisible) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        if ($stmt = mysqli_prepare($conexion, $sql)) {
            mysqli_stmt_bind_param($stmt, "sssssssssssssss", $titulo, $descripcion, $ubicacion, $etiquetas, implode(",", $galeria_fotos), $servicios, $costo_por_dia, $tiempo_minimo, $tiempo_maximo, $cupos, $fechaInicio, $fechaFin, $usuarioID, $fechaPublicacion, $fechaVisible);

            if (mysqli_stmt_execute($stmt)) {
                echo "<script>alert('Ya se realizo su publicación, se vera reflejada en 5 días');";
                echo "window.location.href='index.php';</script>";
                exit();
            } else {
                echo "Error al registrar el alquiler: " . mysqli_error($conexion);
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
        }
    }
} else {
    echo "Error en la preparación de la consulta: " . mysqli_error($conexion);
}
}
mysqli_close($conexion);
?>
