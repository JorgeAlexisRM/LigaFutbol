<?php
require_once "main.php";

// Obtén el idJugador desde la URL
$idJugador = $_GET['idJugador'];
$idEquipo = $_GET['idEquipo'];
$camiseta = (int) $_GET['camis'];

$conexion=conexion();

$consultaEquipo = $conexion->query("SELECT * FROM equipos WHERE nombre='$idEquipo'");
$aux=null;

if($consultaEquipo->rowCount()==1){
    $consultaEquipo=$consultaEquipo->fetch();
    $aux=$consultaEquipo['idEquipo'];
}
// Consulta SQL de UPDATE
$sql = "UPDATE jugadores SET equipo ='$aux',camiseta=$camiseta  WHERE idJugador = '$idJugador'";

// Ejecutar la consulta
$conexion->query($sql);

echo '<h1>El jugador ha sido transferido</h1>';
// Redirige a la página principal o a donde desees después del UPDATE
header('Location: ../index.php?vista=jugador_list');
exit();
?>