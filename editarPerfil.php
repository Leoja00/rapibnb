<?php
session_start();
require_once 'header.php';


if (isset($_SESSION["usuario"])) {
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
<html>
    <body>
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
            <!-- Formulario de edición de perfil -->
            <p style="background: red; color: white; font-weight: bold; padding: 15px; border: 2px solid #fac9d9; border-radius: 6px;">!!! AL HACER ALGUNA MODIFICACIÓN DE UN DATO, SE REPETIRÁ EL PROCESO DE VERIFICACIÓN !!!</p>
            <div class="card mb-4">
                <div class="card-body">
                    <form action="guardarPerfilEditado.php" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $nombre; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="apellido" class="form-label">Apellido</label>
                            <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $apellido; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="dni" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dni" name="dni" value="<?php echo $dni; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="correo" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="correo" name="correo" value="<?php echo $correo; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono</label>
                            <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $telefono; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="intereses" class="form-label">Intereses</label>
                            <textarea class="form-control" id="intereses" name="intereses"><?php echo $intereses; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="biografia" class="form-label">Biografía</label>
                            <textarea class="form-control" id="biografia" name="biografia"><?php echo $biografia; ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Cambiar foto de perfil</label>
                            <input type="file" class="form-control" id="avatar" name="avatar"<?php echo $foto;?>>
                        </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #2596be;color:white;">Guardar Cambios</button>
                        <a href="perfil.php" class="btn btn-secondary" style="background-color: #ED7D6E; color: white;">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="js/editar.js"></script>
</body>
</html>
<?php
require_once "footer.php";
?>
