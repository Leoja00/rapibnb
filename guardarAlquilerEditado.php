<?php
session_start();
require_once 'config.php';

if (isset($_GET["id"])) {
    $alquiler_id = $_GET['id'];
    $queryImagenesAntiguas = "SELECT GaleriaFotos, listadoServicios FROM alquileres WHERE ID = $alquiler_id";
    $resultadoImagenesAntiguas = mysqli_query($conexion, $queryImagenesAntiguas);
    $filaImagenesAntiguas = mysqli_fetch_assoc($resultadoImagenesAntiguas);
    $imagenesAntiguas = explode(",", $filaImagenesAntiguas['GaleriaFotos']);
    $serviciosExistente = $filaImagenesAntiguas['listadoServicios'];

    $titulo = mysqli_real_escape_string($conexion, $_POST['titulo']);
    $descripcion = mysqli_real_escape_string($conexion, $_POST['descripcion']);
    $ubicacion = mysqli_real_escape_string($conexion, $_POST['ubicacion']);
    $etiquetas = mysqli_real_escape_string($conexion, $_POST['etiquetas']);
    $etiquetas_array = explode(" ", $etiquetas);
    $etiquetas = "#" . implode(" #", $etiquetas_array);
    $costoDiario = mysqli_real_escape_string($conexion, $_POST['costo']);
    $diaMinimo = mysqli_real_escape_string($conexion, $_POST['diaMinimo']);
    $diaMaximo = mysqli_real_escape_string($conexion, $_POST['diaMaximo']);
    $cupo = mysqli_real_escape_string($conexion, $_POST['cupo']);
    $diaInicio = mysqli_real_escape_string($conexion, $_POST['fechaInicio']);
    $diaFin = mysqli_real_escape_string($conexion, $_POST['fechaFin']);
    $serviciosNuevos = isset($_POST["servicios"]) ? implode(",", $_POST["servicios"]) : $serviciosExistente;
    $fotos = array();

    if (!empty($_FILES['fotos']['name'][0])) {
        $uploads_dir = 'imgAlquiler';
        foreach ($_FILES['fotos']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['fotos']['name'][$key];
            $file_path = "$uploads_dir/$file_name";

            if (move_uploaded_file($tmp_name, $file_path)) {
                $fotos[] = $file_path;
            } else {
                echo "Error al subir la foto $file_name.";
            }
        }
        if (!empty($imagenesAntiguas)) {
            foreach ($imagenesAntiguas as $imagenAntigua) {
                unlink($imagenAntigua);
            }
        }
        $ruta_imagen = implode(",", $fotos);
    } else {
        $ruta_imagen = implode(",", $imagenesAntiguas);
    }
    $query = "UPDATE alquileres SET Titulo = '$titulo', Descripcion = '$descripcion', Ubicacion = '$ubicacion', Etiquetas = '$etiquetas', listadoServicios = '$serviciosNuevos', CostoAlquilerPorDia = '$costoDiario', TiempoMinimoPermanencia = '$diaMinimo', TiempoMaximoPermanencia = '$diaMaximo', Cupo = '$cupo', FechaInicio='$diaInicio', FechaFin='$diaFin' ,GaleriaFotos = '$ruta_imagen',FechaActualizacion = NOW() WHERE ID = $alquiler_id";
    if (mysqli_query($conexion, $query)) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error al actualizar el alquiler: " . mysqli_error($conexion);
    }
} else {
    echo "ID de alquiler no proporcionado.";
}
?>
