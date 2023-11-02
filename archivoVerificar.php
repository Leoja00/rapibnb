<?php
session_start();
require_once 'header.php';

if (isset($_SESSION["usuario"])) {
    // Consulta para obtener los datos actuales del usuario
    $query = "SELECT nombre, apellido, dni, correoElectronico, telefono, intereses, avatar, biografia FROM usuarios WHERE id = {$_SESSION['usuario']}";
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
    }
}
?>
<br><br><br>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            <!-- Mostrar la imagen de perfil actual -->
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="<?php echo $foto; ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 class="my-3"><?php echo $nombre, " ", $apellido ?></h5>
                </div>
            </div>
        </div>

        <div class="col-lg-8">

            <div class="card mb-4">
                <div class="card-body">
                    <form action="verificacion.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje para verificar</label>
                        <input type="text" class="form-control" id="mensaje" name="mensaje" placeholder="Mensaje" required>
                    </div>
                    <div class="mb-3">
                        <label for="archivo" class="form-label">Mandar archivo para verificar (foto del DNI, o alguna documentación que compruebe tu identificación)</label>
                        <input type="file" class="form-control" id="archivo" name="archivo" required>
                    </div>

                        <button type="submit" class="btn btn-primary" style="background-color: #2596be;color:white;">Mandar para verificar</button>
                        <a href="perfil.php" class="btn btn-secondary" style="background-color: #ED7D6E; color: white;">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require_once "footer.php";
?>
