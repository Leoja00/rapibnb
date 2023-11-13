<?php
require_once 'header.php';
require_once 'config.php';
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
    <br>

    <?php
    $currentDate = date("Y-m-d");
    $sqlVerificados = "SELECT alquileres.* FROM alquileres 
                      JOIN usuarios ON alquileres.UsuarioID = usuarios.ID 
                      WHERE usuarios.Verificado = 1 
                      AND (alquileres.FechaInicio IS NULL OR alquileres.FechaInicio <= '$currentDate' OR FechaInicio = '0000-00-00')
                      AND (alquileres.FechaFin IS NULL OR alquileres.FechaFin >= '$currentDate' OR FechaFin = '0000-00-00')
                      ORDER BY alquileres.FechaPublicacion DESC";
    $resultVerificados = mysqli_query($conexion, $sqlVerificados);

    $count = 0;
    $articles = array();
    ?>

    <?php
    if (mysqli_num_rows($resultVerificados) > 0) {
        ?>
        <div class="destacados"><u>Destacados</u></div>
        <br>
        <div id="postCarousel" class="carousel slide" data-ride="carousel">
            
            <div class="carousel-inner">
                <?php
                while ($row = mysqli_fetch_assoc($resultVerificados)) {
                    $titulo = $row['Titulo'];
                    $descripcion = $row['Descripcion'];
                    $ubicacion = $row['Ubicacion'];
                    $fotos = explode(',', $row['GaleriaFotos']);
                    $primeraFoto = $fotos[0];
                    ?>
                    <div class="carousel-item <?php echo ($count == 0) ? 'active' : ''; ?>">
                        <div class="destacados-content">
                            <article class="post searchable destacado">
                                <div class="post-header">
                                    <div class="post-img-1" style="background-image: url('<?php echo $primeraFoto; ?>');"></div>
                                </div>
                                <div class="post-body">
                                    <h2 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $titulo; ?></h2>
                                    <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b>Descripción:</b> <?php echo $descripcion; ?></p>
                                    <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b>Ubicación:</b> <?php echo $ubicacion; ?></p>
                                    <a href="detalles.php?id=<?php echo $row['ID']; ?>" class="post-link">Detalles...</a>
                                </div>
                            </article>
                        </div>
                    </div>
                    <?php
                    $count++;
                }
                ?>
            </div>

            <a class="carousel-control-prev" href="#postCarousel" role="button" data-slide="prev">
                <span class="custom-prev-icon carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#postCarousel" role="button" data-slide="next">
                <span class="custom-next-icon carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>

        </div>
        <?php
    }

    // ESPACIO SOLAMENTE SI HAY ALQUILERES DESTACADOS SINO NO
    if (mysqli_num_rows($resultVerificados) > 0) {
        echo "<br><br><br>";
    }
    

    //LOS 3 MEJORES CON RESEÑAS
    $sqlTopRentals = "SELECT a.*, AVG(r.Puntaje) AS PromedioPuntaje
        FROM alquileres a
        LEFT JOIN reseñas r ON a.ID = r.AlquilerID
        GROUP BY a.ID
        ORDER BY PromedioPuntaje DESC
        LIMIT 3;";

    $resultTopRentals = mysqli_query($conexion, $sqlTopRentals);
    ?>

    <?php
    if (mysqli_num_rows($resultTopRentals) > 0) {
        ?>
        <section class="post-link">
    <br>
    <div class="content top-rentals-content">
        <?php
        while ($rowTop = mysqli_fetch_assoc($resultTopRentals)) {
            $tituloTop = $rowTop['Titulo'];
            $descripcionTop = $rowTop['Descripcion'];
            $ubicacionTop = $rowTop['Ubicacion'];
            $fotosTop = explode(',', $rowTop['GaleriaFotos']);
            $primeraFotoTop = $fotosTop[0];
            ?>
            <article class="post searchable top-rental">
                <div class="post-header" style="position: relative;">
                    <div class="post-img-1" style="background-image: url('<?php echo $primeraFotoTop; ?>');"></div>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="yellow" class="bi bi-bookmark-star-fill" viewBox="0 0 16 16" style="position: absolute; top: 5px; right: 5px; z-index: 1;">
                        <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zM8.16 4.1a.178.178 0 0 0-.32 0l-.634 1.285a.178.178 0 0 1-.134.098l-1.42.206a.178.178 0 0 0-.098.303L6.58 6.993c.042.041.061.1.051.158L6.39 8.565a.178.178 0 0 0 .258.187l1.27-.668a.178.178 0 0 1 .165 0l1.27.668a.178.178 0 0 0 .257-.187L9.368 7.15a.178.178 0 0 1 .05-.158l1.028-1.001a.178.178 0 0 0-.098-.303l-1.42-.206a.178.178 0 0 1-.134-.098L8.16 4.1z"/>
                    </svg>
                </div>
                <div class="post-body">
                    <h2 style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><?php echo $tituloTop; ?></h2>
                    <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b>Descripción:</b> <?php echo $descripcionTop; ?></p>
                    <p style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"><b>Ubicación:</b> <?php echo $ubicacionTop; ?></p>
                    <a href="detalles.php?id=<?php echo $rowTop['ID']; ?>" class="post-link">Detalles...</a>
                </div>
            </article>
            <?php
        }
        ?>
    </div>
</section>

    <?php
    }
    function isMobile() {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }
    
    $currentDate = date("Y-m-d"); 
    $resultadosPorPagina = isset($_GET['pagina']) && $_GET['pagina'] && is_numeric($_GET['pagina']) ? $_GET['pagina'] : 1;
if (isMobile()) {
    $resultadosPorPagina = 3; // TELEFONO
} else {
    $resultadosPorPagina = 9; // PC
}

    
    $paginaActual = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
    
    $indiceInicio = ($paginaActual - 1) * $resultadosPorPagina;
    
    $sqlRecientes = "SELECT * FROM alquileres 
        WHERE ((FechaInicio IS NULL OR FechaInicio <= '$currentDate' OR FechaInicio = '0000-00-00')
        AND (FechaFin IS NULL OR FechaFin >= '$currentDate' OR FechaFin = '0000-00-00'))
        ORDER BY FechaPublicacion DESC
        LIMIT $indiceInicio, $resultadosPorPagina;";
    
    $resultRecientes = mysqli_query($conexion, $sqlRecientes);
    
    $sqlTotalResultados = "SELECT COUNT(*) AS total FROM alquileres 
        WHERE ((FechaInicio IS NULL OR FechaInicio <= '$currentDate' OR FechaInicio = '0000-00-00')
        AND (FechaFin IS NULL OR FechaFin >= '$currentDate' OR FechaFin = '0000-00-00'))";
    $resultTotalResultados = mysqli_query($conexion, $sqlTotalResultados);
    $rowTotalResultados = mysqli_fetch_assoc($resultTotalResultados);
    $totalResultados = $rowTotalResultados['total'];

    $totalPaginas = max(1, ceil($totalResultados / $resultadosPorPagina));

    if (mysqli_num_rows($resultRecientes) > 0) {
        ?>
        <section class="post-link">
    <div class="destacados"><u>Recientes</u></div>
    <br>
    <div class="content recientes-content">
        <?php
        while ($row = mysqli_fetch_assoc($resultRecientes)) {
            $fechaVisible = strtotime($row['FechaVisible']);
            $fechaActual = strtotime(date("Y-m-d"));

            if ($fechaVisible <= $fechaActual) {
                $titulo = $row['Titulo'];
                $descripcion = $row['Descripcion'];
                $ubicacion = $row['Ubicacion'];
                $fotos = explode(',', $row['GaleriaFotos']);
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
                        <a href="detalles.php?id=<?php echo $row['ID']; ?>" class="post-link">Detalles...</a>
                    </div>
                </article>
                <?php
            }
        }
        ?>
    </div>

    <?php
    if ($totalResultados > 0) {
        echo '<div class="pagination">';
        $maxPagesToShow = 5;
        for ($i = 1; $i <= $totalPaginas; $i++) {
            echo '<a href="?pagina=' . $i . '" class="' . (($i == $paginaActual) ? 'active' : '') . '">' . $i . '</a>';
        }
        echo '</div>';
    } else {
        echo '<div class="no-results" style="display: none;">
                <p class="result-negativo">No hay resultados de búsqueda</p>
              </div>';
    }
    ?>
</section>

<?php
} else {
    echo '<p class="negativo">No hay alquileres disponibles en este momento.</p>';
}

mysqli_close($conexion);
?>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>
