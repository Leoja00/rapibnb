<?php
session_start();
require_once 'header.php';
require_once 'config.php';
require_once 'buscador.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilo/body.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<section class="post-link">
<br><br>
    <div class="destacados"><u>Resultados de búsqueda</u></div>
    <br>
    <div class="content recientes-content">
        <?php

        $terminoBusqueda = $_GET['buscaralquiler'];
$fechaActual = date("Y-m-d");

$sql = "SELECT * FROM alquileres 
        WHERE (Titulo LIKE '%$terminoBusqueda%' 
               OR Descripcion LIKE '%$terminoBusqueda%' 
               OR Ubicacion LIKE '%$terminoBusqueda%' 
               OR Etiquetas LIKE '%#$terminoBusqueda%')
          AND (FechaVisible IS NULL OR FechaVisible <= '$fechaActual')
          AND ((FechaInicio IS NULL OR FechaInicio = '0000-00-00' OR FechaInicio <= '$fechaActual') 
               AND (FechaFin IS NULL OR FechaFin = '0000-00-00' OR FechaFin >= '$fechaActual'))";
          
$resultado = mysqli_query($conexion, $sql);

        if ($resultado->num_rows > 0) {
            while ($fila = $resultado->fetch_assoc()) {
                $titulo = $fila['Titulo'];
                $descripcion = $fila['Descripcion'];
                $ubicacion = $fila['Ubicacion'];
                $fotos = explode(',', $fila['GaleriaFotos']);
                    $primeraFoto = $fotos[0];
                ?>
                <article class="post searchable reciente">
                    <div class="post-header">
                        <div class="post-img-1" style="background-image: url('<?php echo $primeraFoto; ?>');"></div>
                    </div>
                    <div class="post-body">
                        <h2 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $titulo; ?></h2>
                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b>Descripción:</b> <?php echo $descripcion; ?></p>
                        <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b>Ubicación:</b> <?php echo $ubicacion; ?></p>
                        <a href="detalles.php?id=<?php echo $fila['ID']; ?>" class="post-link">Detalles...</a>
                    </div>
                </article>
                <?php
            }
        } else {
            echo '<div class="no-results"><p class="result-negativo">No se encontraron resultados.</p></div>';
        }

        mysqli_close($conexion);
        ?>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    </body>
    </html>
    <?php 
    require_once 'footer.php';
    ?>
    
