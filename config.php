<?php
$baseDeDatos_Host='localhost';
$baseDeDatos_Nombre='rapibnb';
$baseDeDatos_usuario='root';
$baseDeDatos_contrasenia='';

$conexion=mysqli_connect($baseDeDatos_Host,$baseDeDatos_usuario,$baseDeDatos_contrasenia,$baseDeDatos_Nombre);
if(!$conexion){
    die("Error en la conexion a la base de datos" . mysqli_connect_error());
}
$fecha_actual = date("Y-m-d");
//SACA VERIFICADO A USUARIO YA PASADA LA FECHA
$sql_usuarios = "UPDATE usuarios SET verificado = 0, FechaVencimiento = NULL, FechaVerificacion = NULL WHERE FechaVencimiento < '$fecha_actual' AND verificado = 1";

if (mysqli_query($conexion, $sql_usuarios)) {
    
} else {
    echo "Error al actualizar registros de usuarios: " . mysqli_error($conexion);
}

//BORRA RESERVAS PASADA
$sql_reservas = "DELETE FROM reservas WHERE Estado = 'En revision' AND FechaCreacion < DATE_SUB('$fecha_actual', INTERVAL 72 HOUR)";

if (mysqli_query($conexion, $sql_reservas)) {
    
} else {
    echo "Error al borrar reservas: " . mysqli_error($conexion);
}   
?>
