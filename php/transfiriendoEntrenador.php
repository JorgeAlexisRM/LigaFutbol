<?php
require_once "main.php";

// Obtén el idJugador desde la URL
$idJugador = $_GET['idJugador'];
$idEquipo = $_GET['idEquipo'];
$cami = (int) $_GET['cami'];
echo $cami;
$conexion=conexion();
// Consulta SQL de UPDATE
$sql = "UPDATE jugadores SET equipo ='$idEquipo',camiseta=$cami WHERE idJugador = '$idJugador'";

// Ejecutar la consulta
$conexion->query($sql);

echo '<h1>El jugador ha sido transferido a </h1>';
// Redirige a la página principal o a donde desees después del UPDATE
header('Location: ../index.php?vista=jugador_list');
exit();
?>