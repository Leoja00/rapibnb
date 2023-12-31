<?php
session_start();
require_once 'header.php';
require_once 'config.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="estilo/detalles.css">
    <link rel="stylesheet" href="estilo/navbar.css">

    <title>Detalles de Alquiler</title>
</head>
<body>

<?php
$fecha_actual = new DateTime();
if (mysqli_connect_error()) {
    echo "Error en la conexión: " . mysqli_connect_error();
    exit();
}

if (isset($_GET['id'])) {
    $alquiler_id = $_GET['id'];

    $sql = "SELECT * FROM alquileres WHERE ID = $alquiler_id";
    $result = mysqli_query($conexion, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $id = $row['ID'];
            $titulo = $row['Titulo'];
            $descripcion = $row['Descripcion'];
            $ubicacion = $row['Ubicacion'];
            $etiquetas = $row['Etiquetas'];
            $fotos = explode(',', $row['GaleriaFotos']);
            $listado_servicios = $row['ListadoServicios'];
            $costo_alquiler_por_dia = $row['CostoAlquilerPorDia'];
            $tiempo_min_permanencia = $row['TiempoMinimoPermanencia'];
            $tiempo_max_permanencia = $row['TiempoMaximoPermanencia'];
            $cupo = $row['Cupo'];
            $usuario_id = $row['UsuarioID'];
            $fecha_publicacion = $row['FechaPublicacion'];
            $fechaActualizacion = $row['FechaActualizacion'];

            $sql_usuario = "SELECT Nombre, Apellido FROM usuarios WHERE ID = $usuario_id";
            $result_usuario = mysqli_query($conexion, $sql_usuario);

            if ($result_usuario && mysqli_num_rows($result_usuario) > 0) {
                $row_usuario = mysqli_fetch_assoc($result_usuario);
                $nombre_usuario = $row_usuario['Nombre'] . ' ' . $row_usuario['Apellido'];
                $fecha_publicacion = new DateTime($fecha_publicacion);
                $diferencia = $fecha_actual->getTimestamp() - $fecha_publicacion->getTimestamp();
                $dias_transcurridos = floor($diferencia / (60 * 60 * 24));
                if ($dias_transcurridos == 0) {
                    $mensaje_fecha = " Hoy";
                } elseif ($dias_transcurridos == 1) {
                    $mensaje_fecha = " Hace 1 día";
                } else {
                    $mensaje_fecha = " Hace " . $dias_transcurridos . " días";
                }
            } else {
                $nombre_usuario = "Usuario no encontrado";
            }
            ?>

            <!-- Carrusel -->
            <div id="carouselExampleIndicators" class="carousel slide carousel-fade" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?php foreach ($fotos as $index => $foto): ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?=$index?>" <?=$index === 0 ? 'class="active"' : ''?>></li>
                    <?php endforeach;?>
                </ol>
                <div class="carousel-inner">
                    <?php foreach ($fotos as $index => $foto): ?>
                        <div class="carousel-item <?=$index === 0 ? 'active' : ''?>">
                            <img src="<?=$foto?>" class="d-block w-100" alt="Slide <?=$index + 1?>" loading="lazy">
                        </div>
                    <?php endforeach;?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>



            <div class="post">
                <div class="post-body">
                    <h1><?php echo $titulo; ?></h1>
                    <p><b>Descripción:</b> <?php echo $descripcion; ?></p>
                    <p><b>Ubicación:</b> <?php echo $ubicacion; ?></p>
                    <p><b>Etiquetas:</b> <?php echo $etiquetas; ?></p>
                    <p><b>Servicios:</b> <?php echo $listado_servicios; ?></p>
                    <p><b>Costo por día:</b> <?php echo '$' . $costo_alquiler_por_dia; ?></p>
                    <p><b>Tiempo mínimo de permanencia:</b> <?php echo $tiempo_min_permanencia; ?> días</p>
                    <p><b>Tiempo máximo de permanencia:</b> <?php echo $tiempo_max_permanencia; ?> días</p>
                    <p><b>Cupo:</b> <?php echo $cupo; ?></p>
                    <p><b>Publicado por:</b> <?php echo $nombre_usuario; ?></p>
                    <p><b>Creada: </b> <?php echo $mensaje_fecha; ?></p>

                    <?php
if ($fechaActualizacion !== null) {
                $fechaActual = new DateTime();
                $fechaActualizacion = new DateTime($fechaActualizacion);
                $diferencia = $fechaActual->diff($fechaActualizacion);

                if ($diferencia->d == 0) {
                    echo '<p><b>Editado:</b> Hoy</p>';
                } elseif ($diferencia->d == 1) {
                    echo '<p><b>Editado:</b> Hace 1 día</p>';
                } else {
                    echo '<p><b>Editado:</b> Hace ' . $diferencia->d . ' días</p>';
                }
            }
            ?>

                </div>
            </div>


            <!-- OFERTAR -->
            <div class="ofertar">
            <?php if (isset($_SESSION['usuario'])): ?>
    <?php if ($_SESSION['usuario'] == $usuario_id): ?>
        <a href="editarAlquiler.php?id=<?=$alquiler_id?>" class="btn btn-warning" style="margin-left: 5%;">Editar alquiler</a>
        <button type="button" class="btn btn-danger" style="margin-left: 5%;" data-toggle="modal" data-target="#confirmDeleteModal">
            Borrar alquiler
        </button>
        <?php
// RESERVAS CON EL ALQUILER
$sqlReservas = "SELECT r.*, u.Nombre, u.Apellido, u.DNI FROM reservas r JOIN usuarios u ON r.UsuarioID = u.ID WHERE r.AlquilerID = $alquiler_id";
$resultReservas = mysqli_query($conexion, $sqlReservas);

if ($resultReservas && mysqli_num_rows($resultReservas) > 0) {
    echo '<div class="post">';

    // Reservas Hechas
    $contador = 1;
    $hayReservasHechas = false;
    while ($rowReserva = mysqli_fetch_assoc($resultReservas)) {
        if ($rowReserva['Estado'] == "Reservado") {
            if (!$hayReservasHechas) {
                echo '<h4 style="margin-left:1%"><strong><u> RESERVAS YA HECHAS:</strong></u></h4>';
                $hayReservasHechas = true;
            }
            echo '<div class="post-body">';
            echo "<p><b><u>RESERVA N° $contador"?>
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#419549" class="bi bi-bookmark-check-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2 15.5V2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.74.439L8 13.069l-5.26 2.87A.5.5 0 0 1 2 15.5zm8.854-9.646a.5.5 0 0 0-.708-.708L7.5 7.793 6.354 6.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"/>
            </svg>
            <?php echo"</p></b></u>";
            echo '<p><b>Reserva realizada por:</b> ' . $rowReserva['Nombre'] . ' ' . $rowReserva['Apellido'] . '</p>';
            echo '<p><b>DNI del cliente:</b> ' . $rowReserva['DNI'] . '</p>';
            echo '<p><b>Desde :</b> ' . $rowReserva['FechaReservaInicio'];
            echo '<p><b>Hasta :</b> ' . $rowReserva['FechaReservaFin'];
            echo '</div>';
            $contador++;
        }
    }

    // Reservas a Revisar
    mysqli_data_seek($resultReservas, 0);
    $contador = 1;
    $hayReservasARevisar = false;
    while ($rowReserva = mysqli_fetch_assoc($resultReservas)) {
        if ($rowReserva['Estado'] != "Reservado") {
            if (!$hayReservasARevisar) {
                echo "<hr>";
                echo '<h4 style="margin-left:1%"><strong><u> RESERVAS A REVISAR:</strong></u></h4>';
                $hayReservasARevisar = true;
            }
            echo '<div class="post-body">';
            echo "<p><b><u>RESERVA N° $contador"?>
            <button type="button" class="btn btn-light" style="width: 20; height: 20; padding: 0;">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#E6D327" class="bi bi-hourglass-split" viewBox="0 0 16 16">
        <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
    </svg>
    </button>
            
            <?php echo "</p></b></u>";
            echo '<p><b>Reserva realizada por:</b> ' . $rowReserva['Nombre'] . ' ' . $rowReserva['Apellido'] . '</p>';
            echo '<p><b>DNI del cliente:</b> ' . $rowReserva['DNI'] . '</p>';
            echo '<p><b>Desde :</b> ' . $rowReserva['FechaReservaInicio'];
            echo '<p><b>Hasta :</b> ' . $rowReserva['FechaReservaFin'];
            ?>
            <div class="">
                <a href="rechazarReserva.php?id=<?=$rowReserva['AlquilerID']?>&reserva_id=<?=$rowReserva['ID']?>" class="btn btn-danger">Rechazar</a>
                <a href="aceptarReserva.php?id=<?=$rowReserva['AlquilerID']?>&reserva_id=<?=$rowReserva['ID']?>" class="btn btn-success">Reservar</a>

            </div>
            <?php
            echo '</div>';
            $contador++;
        }
    }
    echo '</div>';
}
?>
                <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmar eliminación</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ¿Estás seguro de que deseas eliminar este alquiler?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <a href="borrarAlquiler.php?id=<?=$alquiler_id?>" class="btn btn-danger">Eliminar</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <?php
$sql = "SELECT * FROM alquileres WHERE ID = $alquiler_id";
            $result = mysqli_query($conexion, $sql);
            if ($result) {
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $fechaInicio = $row['FechaInicio'];
                    $fechaFin = $row['FechaFin'];
                    $minimo = $row['TiempoMinimoPermanencia'];
                    $maximo = $row['TiempoMaximoPermanencia'];
                    $costo = $row['CostoAlquilerPorDia'];
                }
            }
            ?>

<?php
$usuario_actual = $_SESSION['usuario'];
$sql_reserva = "SELECT * FROM reservas WHERE UsuarioID = $usuario_actual AND AlquilerID = $alquiler_id ORDER BY FechaReservaFin DESC LIMIT 1";
$result_reserva = mysqli_query($conexion, $sql_reserva);

if (mysqli_num_rows($result_reserva) > 0) {
    $reserva_info = mysqli_fetch_assoc($result_reserva);
    $estado_reserva = $reserva_info['Estado'];

    if ($estado_reserva == "En revision") {
        echo "<button type='button' class='btn btn-warning' style='margin-left:5%' >¡ALQUILER EN REVISION!</button>";
    } else {
        $fecha_reserva_fin = $reserva_info['FechaReservaFin'];
        $fecha_actual = date('Y-m-d');

        if ($fecha_reserva_fin < $fecha_actual) {?>
                <button type="button" class="btn btn-primary" style="margin-left: 5%;" data-toggle="modal" data-target="#ofertaModal">RESERVAR</button>
            <div class="modal fade" id="ofertaModal" tabindex="-1" role="dialog" aria-labelledby="ofertaModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ofertaModalLabel">Detalles de la reserva</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="cantidadPersonas">Cantidad de personas:</label>
                                    <input type="number" class="form-control" id="cantidadPersonas" name="cantidadPersonas">
                                </div>
                                <div class="form-group">
                                    <label for="fechaDesde">Desde:</label>
                                    <input type="date" class="form-control" id="fechaDesde" name="fechaDesde" min="<?php echo $fechaInicio; ?>" max="<?php echo $fechaFin; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="fechaHasta">Hasta:</label>
                                    <input type="date" class="form-control" id="fechaHasta" name="fechaHasta" min="<?php echo $fechaInicio; ?>" max="<?php echo $fechaFin; ?>">
                                </div>
                            <?php
$sql = "SELECT * FROM alquileres WHERE ID = $alquiler_id";
                $result = mysqli_query($conexion, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $minimo = $row['TiempoMinimoPermanencia'];
                        $maximo = $row['TiempoMaximoPermanencia'];
                        $costo = $row['CostoAlquilerPorDia'];
                    }
                }
                ?>

                            <button type="button" class="btn btn-primary" onclick="calcularTotal(<?php echo $costo ?>, <?php echo $minimo ?>, <?php echo $maximo ?>, <?php echo $cupo ?>)">Calcular</button>
                            <span id="total" class="total-estilo align-right"></span>
                        </div>
                        <div class="modal-footer">
                        <form method="post" action="procesarReserva.php?id=<?php echo $alquiler_id; ?>" id="reservaForm">
                            <input type="hidden" id="formFechaDesde" name="fechaDesde">
                            <input type="hidden" id="formFechaHasta" name="fechaHasta">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success" id="btnReservar" style="display:none;">Reservar</button>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }else {
            echo "<button type='button' class='btn btn-info' style='margin-left:5%' >¡ALQUILER YA RESERVADO!</button>";
        };}
            } else {

                ?>
            <button type="button" class="btn btn-primary" style="margin-left: 5%;" data-toggle="modal" data-target="#ofertaModal">RESERVAR</button>
            <div class="modal fade" id="ofertaModal" tabindex="-1" role="dialog" aria-labelledby="ofertaModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="ofertaModalLabel">Detalles de la reserva</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                                <div class="form-group">
                                    <label for="cantidadPersonas">Cantidad de personas:</label>
                                    <input type="number" class="form-control" id="cantidadPersonas" name="cantidadPersonas">
                                </div>
                                <div class="form-group">
                                    <label for="fechaDesde">Desde:</label>
                                    <input type="date" class="form-control" id="fechaDesde" name="fechaDesde" min="<?php echo $fechaInicio; ?>" max="<?php echo $fechaFin; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="fechaHasta">Hasta:</label>
                                    <input type="date" class="form-control" id="fechaHasta" name="fechaHasta" min="<?php echo $fechaInicio; ?>" max="<?php echo $fechaFin; ?>">
                                </div>
                            <?php
$sql = "SELECT * FROM alquileres WHERE ID = $alquiler_id";
                $result = mysqli_query($conexion, $sql);
                if ($result) {
                    if (mysqli_num_rows($result) > 0) {
                        $row = mysqli_fetch_assoc($result);
                        $minimo = $row['TiempoMinimoPermanencia'];
                        $maximo = $row['TiempoMaximoPermanencia'];
                        $costo = $row['CostoAlquilerPorDia'];
                    }
                }
                ?>

                            <button type="button" class="btn btn-primary" onclick="calcularTotal(<?php echo $costo ?>, <?php echo $minimo ?>, <?php echo $maximo ?>, <?php echo $cupo ?>)">Calcular</button>
                            <span id="total" class="total-estilo align-right"></span>
                        </div>
                        <div class="modal-footer">
                        <form method="post" action="procesarReserva.php?id=<?php echo $alquiler_id; ?>" id="reservaForm">
                            <input type="hidden" id="formFechaDesde" name="fechaDesde">
                            <input type="hidden" id="formFechaHasta" name="fechaHasta">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-success" id="btnReservar" style="display:none;">Reservar</button>
                            </div>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        <?php }
            endif;?>
    <?php else: ?>
        <a href="login.php" class="btn btn-primary" style="margin-left: 5%;">Iniciar sesión para reservar</a>
    <?php endif;?>
</div>

<!--RESEÑAS LAS HACE QUIEN REALIZO LA RESERVA Y TERMINO SU FECHA DE RESERVA-->
<?php
if (isset($_SESSION['usuario']) && isset($_GET['id'])) {
    $usuario_id = $_SESSION['usuario'];
    $alquiler_id = $_GET['id'];

    $sqlVerificarUsuario = "SELECT Verificado FROM usuarios WHERE ID = '$usuario_id'";
    $resultVerificarUsuario = mysqli_query($conexion, $sqlVerificarUsuario);

    if ($resultVerificarUsuario) {
        $rowVerificarUsuario = mysqli_fetch_assoc($resultVerificarUsuario);
        $usuarioVerificado = $rowVerificarUsuario['Verificado'];
        $sqlVerificarFecha = "SELECT COUNT(*) as total FROM reservas WHERE UsuarioID = '$usuario_id' AND AlquilerID = '$alquiler_id' AND CURDATE() > FechaReservaFin";
        $resultVerificarFecha = mysqli_query($conexion, $sqlVerificarFecha);

        if ($resultVerificarFecha && $usuarioVerificado == 1) {
            $rowVerificarFecha = mysqli_fetch_assoc($resultVerificarFecha);
            $reservasVencidas = $rowVerificarFecha['total'];
            if ($reservasVencidas > 0) {
                $sqlObtenerReservaID = "SELECT ID FROM reservas WHERE UsuarioID = '$usuario_id' AND AlquilerID = '$alquiler_id' AND CURDATE() > FechaReservaFin";
                $resultObtenerReservaID = mysqli_query($conexion, $sqlObtenerReservaID);
                if ($resultObtenerReservaID) {
                    $rowObtenerReservaID = mysqli_fetch_assoc($resultObtenerReservaID);
                    $reserva_id = $rowObtenerReservaID['ID'];
                    $sqlVerificarResena = "SELECT COUNT(*) as total FROM reseñas WHERE UsuarioID = '$usuario_id' AND AlquilerID = '$alquiler_id'";
                    $resultVerificarResena = mysqli_query($conexion, $sqlVerificarResena);
                    if ($resultVerificarResena) {
                        $rowVerificarResena = mysqli_fetch_assoc($resultVerificarResena);
                        $reseñasExisten = $rowVerificarResena['total'];
                        if ($reseñasExisten > 0) {
                            
                        } else {
                            // ESTO SINO HA HECHO YA UNA RESEÑA
                            $sqlUserInfo = "SELECT Nombre, Apellido, Avatar FROM usuarios WHERE ID = '$usuario_id'";
                            $resultUserInfo = mysqli_query($conexion, $sqlUserInfo);

                            if ($resultUserInfo) {
                                $rowUserInfo = mysqli_fetch_assoc($resultUserInfo);
                                $nombreUsuario = $rowUserInfo['Nombre'];
                                $apellidoUsuario = $rowUserInfo['Apellido'];
                                echo '<div class="post">';
                                echo '<div class="post-body">';
                                echo '<h3><u>Escriba su reseña</u></h3>';
                                echo '<form action="procesarResenia.php" method="post">';
                                echo '<p>Nombre: ' . $nombreUsuario . ' ' . $apellidoUsuario . '</p>';
                                echo '<div style="display: flex;">';
                                echo '<textarea name="resena" id="resena" placeholder="Escriba tu reseña aquí" style="flex: 1;"></textarea>';
                                echo '</div>';
                                echo '<input type="hidden" name="usuario_id" value="'.$usuario_id.'">';
                                echo '<input type="hidden" name="alquiler_id" value="'.$alquiler_id.'">';
                                echo '<input type="hidden" name="reserva_id" value="'.$reserva_id.'">';
                                echo '<input type="hidden" name="puntuacion" id="puntuacion" value="0">'; 
                                ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                                  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                                <?php
                                echo '<button type="button" onclick="borrarResena()" class="btn btn-danger" style="margin-top: 1%;">Borrar Reseña</button>';
                                echo '<button type="submit" class="btn btn-primary" style="margin-top: 1%; margin-left: 10px;">Guardar Reseña</button>';
                                echo '</form>';
                                echo '</div>';
                                echo '</div>';
                            }
                        }
                    }
                }
            }
        }
    }
}
?>

<!--ESTRELLAS-->
<script>
    var estrellas = document.querySelectorAll(".bi-star-fill");
    estrellas.forEach(function(estrella, index) {
        estrella.addEventListener("click", function() {
            document.getElementById("puntuacion").value = index + 1;
            actualizarEstrellas(index + 1);
        });
    });

    function actualizarEstrellas(puntuacion) {
        estrellas.forEach(function(estrella, index) {
            if (index < puntuacion) {
                estrella.classList.add("text-warning");
            } else {
                estrella.classList.remove("text-warning");
            }
        });
    }
</script>

<?php
function mostrarEstrellas($puntaje) {
    $estrellas = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $puntaje) {
            $estrellas .= '<span style="color: #ffd700;">★</span>'; 
        } else {
            $estrellas .= '<span style="color: #d3d3d3;">★</span>'; 
        }
    }
    return $estrellas;
}

$reseniasTodo = "SELECT reseñas.ID, reseñas.Comentario, reseñas.Puntaje, usuarios.Nombre, usuarios.Apellido, usuarios.Avatar, reseñas.RespuestaDueño FROM reseñas JOIN usuarios ON reseñas.UsuarioID = usuarios.ID WHERE reseñas.AlquilerID = $alquiler_id";
$resultResenias = mysqli_query($conexion, $reseniasTodo);

if ($resultResenias->num_rows > 0) {
    ?>
    <div class="post">
        <h2 style="margin-left:1%"><u>Reseñas</u></h2>
        <?php
        while ($row = $resultResenias->fetch_assoc()) {
            ?>
            <div class="post-body">
                <div style="background: #bdf0fa; padding: 15px; border: 2px solid #abecf9; border-radius: 6px;">
                    <img src="<?php echo '' . $row["Avatar"]; ?>" alt="avatar" style="width: 70px; float: left; margin-right: 10px;">
                    <p style="color: #0c92ac; font-weight: bold;">
                        <u><strong><?php echo $row["Nombre"] . " " . $row["Apellido"]; ?></u></strong> dice:
                    </p>
                    <div style="margin-left: 80px;">
                        <?php echo $row["Comentario"]; ?>
                        <br>
                        <?php echo mostrarEstrellas($row["Puntaje"]); ?>

                        <!-- RESPUESTA DEL DUEÑO -->
                        <?php
                        $respuestaDueño = $row["RespuestaDueño"];
                        if (!empty($respuestaDueño)) {
                            ?>
                            <div style="background: #e2fdf4;  padding: 15px; border: 2px solid #bdfae6; border-radius: 6px;">
                                <p style="color: #0ebd84; font-weight: bold;">
                                    <u><strong><?php echo 'Respuesta del dueño:' ?></u></strong>
                                </p>
                                <div>
                                    <?php echo $respuestaDueño; ?>
                                    <br>
                                </div>
                            </div>
                        <?php }
                        ?>

                        <!-- FORMULARIO DE RESPUESTA DEL DUEÑO -->
                        <?php
                        if (isset($_SESSION['usuario']) && isset($_GET['id'])) {
                            $usuario_id = $_SESSION['usuario'];
                            $alquiler_id = $_GET['id'];
                            $reseña_id = $row["ID"];

                            $sqlVerificarDueño = "SELECT COUNT(*) as total FROM alquileres WHERE ID = '$alquiler_id' AND UsuarioID = '$usuario_id'";
                            $resultVerificarDueño = mysqli_query($conexion, $sqlVerificarDueño);

                            if ($resultVerificarDueño) {
                                $rowVerificarDueño = mysqli_fetch_assoc($resultVerificarDueño);
                                $esDueño = $rowVerificarDueño['total'];

                                if ($esDueño > 0 && empty($respuestaDueño)) {
                                    echo '<form action="procesarRespuestaDueño.php" method="post">';
                                    echo '<br>';
                                    echo '<div style="display: flex;">';
                                    echo '<br>';
                                    echo '<textarea name="respuesta" id="respuesta" placeholder="Escriba su respuesta acá" style="flex: 1;"></textarea>';
                                    echo '<input type="hidden" name="alquiler_id" value="' . $alquiler_id . '">';
                                    echo '<input type="hidden" name="reseña_id" value="' . $reseña_id . '">';
                                    echo '</div>';
                                    echo '<button type="button" onclick="borrarRespuesta()" class="btn btn-danger" style="margin-top: 1%;">Borrar respuesta</button>';
                                    echo '<button type="submit" class="btn btn-primary" style="margin-top: 1%; margin-left: 10px;">Guardar respuesta</button>';
                                    echo '</form>';
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
<?php
}
?>



<script>
    function borrarResena() {
        document.getElementById('resena').value = '';
    }
    function borrarRespuesta(){
        document.getElementById('respuesta').value='';
    }
</script>
            <?php
} else {
            echo "No se encontraron detalles para el alquiler elegido.";
        }
    } else {
        echo "Error en la consulta: " . mysqli_error($conexion);
    }
} else {
    echo "ID incorrecto.";
}

mysqli_close($conexion);
?>

</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

<script src ="js/reserva.js"></script>

</body>
</html>

<?php
require_once 'footer/footer2.php';
?>