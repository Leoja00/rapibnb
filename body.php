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

    $currentDate = date("Y-m-d "); 

    $sqlRecientes = "SELECT * FROM alquileres 
    WHERE ((FechaInicio IS NULL OR FechaInicio <= '$currentDate' OR FechaInicio = '0000-00-00')
    AND (FechaFin IS NULL OR FechaFin >= '$currentDate' OR FechaFin = '0000-00-00'))
    ORDER BY FechaPublicacion DESC;";

    $resultRecientes = mysqli_query($conexion, $sqlRecientes);
    
    ?>

    <?php
    if (mysqli_num_rows($resultRecientes) > 0) {
        ?>
        <section class="post-link">
            <div class="destacados"><u>Recientes</u></div>
            <br>
            <div class="content recientes-content">
                <?php
                while ($row = mysqli_fetch_assoc($resultRecientes)) {
                    $fechaVisible = strtotime($row['FechaVisible']);
                    $fechaActual = strtotime(date("Y-m-d "));

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
                        <div class="no-results" style="display: none;">
                            <p class="result-negativo">No hay resultados de búsqueda</p>
                        </div>
                        <?php
                    }
                }
            } else {
                echo '<p class="negativo">No hay alquileres disponibles en este momento.</p>';
            }

            mysqli_close($conexion);
            ?>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="js/buscador.js"></script>
</body>
</html>
