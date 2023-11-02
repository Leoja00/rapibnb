<?php
session_start();
require_once 'header.php';
$sql = "SELECT * FROM usuarios";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="estilo/panel.css">
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
      <th>TELÉFONO</th>
      <th>CORREO</th>
      <th>VERIFICADO</th>
      <th>ESTADO</th>
    </tr>
  </thead>
  <tbody>
  <?php
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
        echo "<td>" . $row["ID"] . "</td>";
        echo "<td>" . $row["Nombre"] ." ".$row['Apellido']."</td>";
        echo "<td>" . $row["DNI"] . "</td>";
        echo "<td>" . $row["Telefono"] . "</td>";
        echo "<td>" . $row["CorreoElectronico"] . "</td>";
        echo "<td>" . ($row["Verificado"] == 0 ? "No" : "Sí") . "</td>";
        echo "<td>";
        echo "<form method='post' action='panelAdminVerificacion.php'>";
        echo "<input type='hidden' name='userID' value='" . $row["ID"] . "'>";
        echo "<input type='submit' value='Ver solicitud'>";
        echo "</form>";
      echo "</td>";
      echo "</tr>";
    }
  } else {
    echo "No se encontraron registros.";
  }
  ?>
  </tbody>
</table>

</body>
</html>
<?php
require_once 'footer.php'?>
