<?php
session_start();
require_once 'header.php';
require_once 'config.php';

if (mysqli_connect_errno()) {
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
            $costoDiario = $row['CostoAlquilerPorDia'];
            $duracionMinima= $row['TiempoMinimoPermanencia'];
            $duracionMaxima= $row['TiempoMaximoPermanencia'];
            $cupo = $row['Cupo'];
            $fechaInicio=$row['FechaInicio'];
            $fechaFin=$row['FechaFin'];
        }
             }}        
            ?>
            
<br><br><br>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-4">
            
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="<?php echo $fotos[0]; ?>" alt="avatar" class=" img-fluid" style="width: 400px;">
                    <h5 class="my-3"><?php echo $titulo?></h5>
                    <h6 class="my-3"><?php echo 'Ubicación: '.$ubicacion?></h6>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                <form action="guardarAlquilerEditado.php?id=<?php echo $alquiler_id; ?>" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label for="titulo" class="form-label">Titulo</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $titulo; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $descripcion; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="ubicacion" class="form-label">Ubicación</label>
                            <input type="text" class="form-control" id="ubicacion" name="ubicacion" value="<?php echo $ubicacion; ?>">
                        </div><div class="mb-3">
                            <label for="etiquetas" class="form-label">Etiquetas</label>
                            <input type="text" class="form-control" id="etiquetas" name="etiquetas" value="<?php echo str_replace ("#", "", $etiquetas); ?>">
                        </div>
                        <div class="mb-3">
                            <label for="costo" class="form-label">Costo diario</label>
                            <input type="number" class="form-control" id="costo" name="costo" value="<?php echo $costoDiario; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="diaMinimo" class="form-label"><Datag>Duración mínima (días)</Datag></label>
                            <input type="number" class="form-control" id="diaMinimo" name="diaMinimo" value="<?php echo $duracionMinima; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="diaMaximo" class="form-label">Duración máxima (días)</label>
                            <input type="number" class="form-control" id="diaMaximo" name="diaMaximo" value="<?php echo $duracionMaxima; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="cupo" class="form-label">Cupo</label>
                            <input type="number" class="form-control" id="cupo" name="cupo" value="<?php echo $cupo; ?>">
                        </div>
                        <div class="mb-3">
                        <label for="fechaInicio" class="form-label">Fecha de inicio de publicación (opcional)</label>
                        <?php
                            if ($fechaInicio != null) {
                                echo "<input type='date' class='form-control' id='fechaInicio' name='fechaInicio' value='$fechaInicio'>";
                            } else {
                                echo "<input type='date' class='form-control' id='fechaInicio' name='fechaInicio'>";
                            }
                        ?>
                        </div>
                        <div class="mb-3">
                            <label for="fechaFin" class="form-label">Fecha fin de la publicación (opcional)</label>
                            <?php
                            if ($fechaInicio != null) {
                                echo "<input type='date' class='form-control' id='fechaFin' name='fechaFin' value='$fechaFin'>";
                            } else {
                                echo "<input type='date' class='form-control' id='fechaFin' name='fechaFin'>";
                            }
                        ?>
                        </div>
                        <div class="mb-3">
                            <label for="fotos" class="form-label">Cambiar galería de fotos</label>
                            <input type="file" class="form-control" id="fotos" name="fotos[]" accept="image/*" multiple >
                        </div>
                        <div class="mb-3">
                        <label for="servicios" class="form-label">Seleccione servicio/s</label>
                        <select id="servicios" multiple="multiple" class="form-control" name="servicios[]">
                            <?php
                            $serviciosSeleccionados = explode(',', $listado_servicios); 
                            $serviciosDisponibles = array("wifi", "desayuno", "merienda", "limpieza", "cochera");

                            foreach ($serviciosDisponibles as $servicio) {
                                $selected = in_array($servicio, $serviciosSeleccionados) ? 'selected' : '';
                                echo "<option value='$servicio' $selected>$servicio</option>";
                            }
                            ?>
                        </select>
                    </div>
                        <button type="submit" class="btn btn-primary" style="background-color: #2596be;color:white;">Guardar Cambios</button>
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
