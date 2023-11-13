<?php
session_start();
require_once 'header.php';
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

</head>
<body>


<?php
if (isset($_SESSION["usuario"])) {
    $query = "SELECT nombre,apellido,dni,correoElectronico,telefono,intereses,avatar,biografia,rol,verificado,mensajeVerificacion,archivoVerificacion FROM usuarios WHERE id = {$_SESSION['usuario']}";
    $result = mysqli_query($conexion, $query);
    if ($row = mysqli_fetch_assoc($result)) {
        $nombre = $row['nombre'];
        $apellido = $row['apellido'];
        $dni = $row['dni'];
        $correo = $row['correoElectronico'];
        $telefono = $row['telefono'];
        $intereses = $row['intereses'];
        $foto = $row['avatar'];
        $biografia = $row['biografia'];
        $rol = $row['rol'];
        $verificado = $row['verificado'];
        $mensaje = $row['mensajeVerificacion'];
        $archiv = $row['archivoVerificacion'];
    }
}
?>

<br> <br><br>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="<?php echo $foto; ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3"><?php echo $nombre, " ", $apellido ?></h5>
                    <?php
if ($rol == 1) {
    echo '<p class="my-3">Usuario administrador <svg xmlns="http://www.w3.org/2000/svg"style=" color: #2596be; width="30" height="30" fill="currentColor" class="bi bi-person-gear" viewBox="0 0 16 16">
                        <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm.256 7a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Zm3.63-4.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l.074.136c.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                      </svg></p>';
} else {
    if ($verificado == 0) {
        echo '<p class="my-3">Usuario regular
        <svg xmlns="http://www.w3.org/2000/svg" style=" color: #2596be; width="23" height="23" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1Zm0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                              </svg>
        </p>';
    } else {
        echo '<p class="my-3">Usuario verificado
        <svg xmlns="http://www.w3.org/2000/svg"style=" color: #2596be; width="23" height="23" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                              </svg>
        </p>';
    }

}
?>
                    <div class="d-flex justify-content-center mb-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Editar perfil</button>
                        <div class="modal" id="myModal">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">!!!ADVERTENCIA!!!</h4>
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Si continuas, tendras que hacer los pasos de verificación nuevamente</p>
                                    </div>
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" onclick="window.location.href='editarPerfil.php'">Continuar</button>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary ms-1" onclick="window.location.href='cerrarLogin.php'">Cerrar sesión</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8" style="margin-bottom: -50px;">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nombre completo</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $nombre, " ", $apellido ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">DNI</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $dni ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Telefono</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $telefono ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Correo</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $correo ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Biografia</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $biografia ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Intereses</p>
                        </div>
                        <div class="col-sm-9">
                            <p class="text-muted mb-0"><?php echo $intereses ?></p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Tipo de usuario</p>
                        </div>

                        <div class="col-sm-9">
                            <?php
if ($rol == 1) {
    echo '<p class="text-muted mb-0">Usuario administrador</p>';
} else {
    if ($verificado == 0) {
        echo '<p class="text-muted mb-0">Usuario regular</p>';
    } else {
        echo '<p class="text-muted mb-0">Usuario verificado</p>';
    }

}
?>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Verificado</p>
                        </div>
                        <div class="col-sm-9">
                            <?php
if ($verificado == 1) {
    echo '<p class="text-muted mb-0">Si   <svg xmlns="http://www.w3.org/2000/svg"style=" color: #2596be; width="23" height="23" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                              </svg></p>';
} else {
    echo '<p class="text-muted mb-0">No  <svg xmlns="http://www.w3.org/2000/svg" style=" color: #2596be; width="23" height="23" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7ZM11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1Zm0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"/>
                                <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"/>
                              </svg></p>';
    echo "<br>";

    if (!empty($mensaje)) {
        echo '<button type="button" class="btn btn-warning">Se encuentra en revisión su verificación</button>';
        echo '<br><br>';
        echo '<button type="button" class="btn btn-primary" onclick="window.location.href=\'archivoVerificar.php\'">Modificar archivos enviados</button>';
    } else {
        echo '<button type="button" class="btn btn-warning" onclick="window.location.href=\'archivoVerificar.php\'">Mandar archivos para verificar</button>';

    }
}

?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--ALQUILERES-->
<?php
$alquilerQuery = "SELECT * FROM alquileres WHERE usuarioID = {$_SESSION['usuario']}";
$alquilerResult = mysqli_query($conexion, $alquilerQuery);

if (mysqli_num_rows($alquilerResult) >= 1) {
    echo "
    <div class='container py-5'>
        <div class='row'>
            <div class='col-lg-4'>
            </div>
            <div class='col-lg-8' style='margin-bottom: -50px;'>
                <div class='card mb-4'>
                    <h4 style='margin-left:2%'><u>Listado de alquileres</u></h4>";

    while ($row = mysqli_fetch_assoc($alquilerResult)) {
        $titulo = $row['Titulo'];
        $alquiler_id = $row['ID'];
        echo "<div class='card-body'>
                    <div class='row'>
                        <div class='col-sm-3'>
                            <p class='mb-0'>Título</p>
                        </div>
                        <div class='col-sm-9'>
                        <p class=' mb-0'><strong>$titulo</strong><br><a href='detalles.php?id=$alquiler_id' class='btn btn-info' style='margin-left: 5%;'>Ver alquiler</a>
                            <a href='editarAlquiler.php?id=$alquiler_id' class='btn btn-warning' style='margin-left: 5%;'>Editar alquiler</a>
                            ";?>
                            <button type="button" class="btn btn-danger" style="margin-left: 5%;" data-toggle="modal" data-target="#confirmDeleteModal">
                    Borrar alquiler
                </button>
            
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
                </div><?php
echo "</div>
                    </div>
                </div>
                </div>
                <hr>"
        ;
    }

    echo "</div>
            </div>
        </div>
    </div>";
}
?>

<?php
$reservaQuery = "SELECT * FROM reservas WHERE UsuarioID = {$_SESSION['usuario']}";
$reservaResult = mysqli_query($conexion, $reservaQuery);

if (mysqli_num_rows($reservaResult) >= 1) {
    echo "
    <div class='container py-5'>
        <div class='row'>
            <div class='col-lg-4'>
            </div>
            <div class='col-lg-8' style='margin-bottom: -50px;'>
                <div class='card mb-4'>
                    <h4 style='margin-left:2%'><u>Listado de reservas</u></h4>";

    while ($row = mysqli_fetch_assoc($reservaResult)) {
        $alquiler_id = $row['AlquilerID'];
        $estado = $row['Estado'];
        $fechaInicio = $row['FechaReservaInicio'];
        $fechaFin = $row['FechaReservaFin'];


        $alquilerQuery = "SELECT Titulo FROM alquileres WHERE ID = $alquiler_id";
        $alquilerResult = mysqli_query($conexion, $alquilerQuery);
        $alquilerRow = mysqli_fetch_assoc($alquilerResult);
        $tituloAlquiler = $alquilerRow['Titulo'];


        if ($estado == "Reservado") {
            $buttonClass = "btn btn-primary";  //RESERVADO
        } else {
            $buttonClass = "btn btn-warning";  // EN REVISION
        }

        echo "<div class='card-body'>
                    <div class='row'>
                        <div class='col-sm-3'>
                            <p class='mb-0'>Título del alquiler</p>
                        </div>
                        <div class='col-sm-9'>
                            <p class='mb-0'><strong>$tituloAlquiler</strong></p>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-3'>
                            <p class='mb-0'>Estado</p>
                        </div>
                        <div class='col-sm-9'>
                            <p class='mb-0'><strong>$estado</strong></p>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-3'>
                            <p class='mb-0'>Fecha de inicio</p>
                        </div>
                        <div class='col-sm-9'>
                            <p class='mb-0'><strong>$fechaInicio</strong></p>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-3'>
                            <p class='mb-0'>Fecha de fin</p>
                        </div>
                        <div class='col-sm-9'>
                            <p class='mb-0'><strong>$fechaFin</strong></p>
                        </div>
                    </div>";
                    if ($estado == "Reservado") {
                        echo "<div class='row'>
                        <div class='col-sm-12'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-bookmark-check' viewBox='0 0 16 16' style='color: green;'>
                            <path fill-rule='evenodd' d='M10.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z'/>
                            <path d='M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z'/>
                        </svg>
                        <span style='margin-left: 5px;'>¡Tu reserva está confirmada!</span>
                    </div>
                 </div>";
                }else{
                    echo "<div class='row'>
                        <div class='col-sm-12'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='25' height='25' fill='currentColor' class='bi bi-eye' viewBox='0 0 16 16' style='color:#F4E87C'>
                            <path d='M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z'/>
                            <path d='M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z'/>
                        </svg>
                        <span style='margin-left: 5px;'>¡Tu reserva está en revisión!</span>
                    </div>
                 </div>";
                }

        echo "<div class='row'>
                        <div class='col-sm-12'>
                            <a href='detalles.php?id=$alquiler_id' class='$buttonClass' style='margin-top: 10px;'>Ver alquiler</a>
                        </div>
                    </div>
                    <hr>
                </div>";
    }

    echo "</div>
            </div>
        </div>
    </div>";
} else {
    echo "<p>No se encontraron reservas.</p>";
}
?>




</body>
</html>


<?php
require_once "footer.php";
?>
