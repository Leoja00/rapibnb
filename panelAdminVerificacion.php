<?php
session_start();
require_once 'header.php';

if (isset($_POST['userID'])) {
    $userID = $_POST['userID'];
   
    $sql = "SELECT * FROM usuarios WHERE ID = $userID";
    $result = $conexion->query($sql);

    if ($result->num_rows > 0) {
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="estilo/panelVerificar.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <br><br><br>
    <h1 class="titulo">Panel de administradores</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE COMPLETO</th>
                <th>DNI</th>
                <th>MENSAJE</th>
                <th>ARCHIVO</th>
                <th>ESTADO</th>
            </tr>
        </thead>
        <tbody>

<?php
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["ID"] . "</td>";
            echo "<td>" . $row["Nombre"] ." ".$row['Apellido']."</td>";
            echo "<td>" . $row["DNI"] . "</td>";
            echo "<td>" . $row["MensajeVerificacion"] . "</td>";
            $archivo = $row["ArchivoVerificacion"];

            if ($archivo == null) {
                echo "<td></td>";
            } else {
                echo "<td><a href='#' data-toggle='modal' data-target='#imagenModal{$row["ID"]}'>Ver Archivo</a></td>";
                echo "<div class='modal fade' id='imagenModal{$row["ID"]}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
                echo "<div class='modal-dialog' role='document'>";
                echo "<div class='modal-content'>";
                echo "<div class='modal-header'>";
                echo "<h5 class='modal-title' id='exampleModalLabel'>Archivo de Verificación</h5>";
                echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
                echo "<span aria-hidden='true'>&times;</span>";
                echo "</button>";
                echo "</div>";
                echo "<div class='modal-body'>";
                echo "<img src='$archivo' style='max-width: 100%; height: auto;' />";
                echo "</div>";
                echo "<div class='modal-footer'>";
                echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cerrar</button>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }

            echo "<td>";
            echo "<form method='post' action='panelAdminActualizar.php'>"; 
            echo "<input type='hidden' name='userID' value='" . $row["ID"] . "'>";

            if ($row["Verificado"] == 1) {
                echo "<button type='button' class='btn btn-success'>Ya verificado</button>";
            } else {
                if (empty($row["MensajeVerificacion"]) && empty($row["ArchivoVerificacion"])) {
                    echo "<button type='button' class='btn btn-danger'>No solicitó verificación</button>"; 
                } else {
                    echo "<button type='button' class='btn btn-primary' data-toggle='modal' data-target='#verificarModal{$row["ID"]}'>Verificar</button>";
                }
            }

            echo "</form>";
            echo "</td>";
            echo "</tr>";

            // Modal de Verificación específico para cada usuario
            echo "<div class='modal fade' id='verificarModal{$row["ID"]}' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>";
            echo "<div class='modal-dialog' role='document'>";
            echo "<div class='modal-content'>";
            echo "<div class='modal-header'>";
            echo "<h5 class='modal-title' id='exampleModalLabel'>Verificación</h5>";
            echo "<button type='button' class='close' data-dismiss='modal' aria-label='Close'>";
            echo "<span aria-hidden='true'>&times;</span>";
            echo "</button>";
            echo "</div>";
            echo "<div class='modal-body'>";
            echo "<form method='post' action='panelAdminActualizar.php'>";
            echo "<input type='hidden' name='userID' value='{$row["ID"]}'>";

            echo "<label for='fechaVencimiento'>Fecha de Vencimiento:</label>";
            $fechaMinima = date('Y-m-d', strtotime('+1 day'));
            echo "<input type='date' name='fechaVencimiento' min='{$fechaMinima}' required>";
            echo "<div class='modal-footer'>";
            echo "<button type='submit' class='btn btn-primary'>Verificar</button>";
            echo "<button type='button' class='btn btn-secondary' data-dismiss='modal'>Cancelar</button>";
            echo "</div>";
            echo "</form>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
?>
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>

<?php
    } else {
        echo "No se encontraron registros para el usuario con ID: $userID";
    }
} else {
    echo "No se proporcionó un ID de usuario.";
}

require_once 'footer.php';
?>
