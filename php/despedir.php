<?php

// Obtén la conexión a la base de datos (reemplaza con tu método de conexión)
$conexion = new mysqli('localhost', 'root', '', 'ligaChachis');

// Verifica la conexión
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtén el idJugador desde la URL
$idJugador = $_GET['idJugador'];

// Consulta SQL de UPDATE
$sql = "UPDATE jugadores SET equipo = NULL WHERE idJugador = '$idJugador'";

// Ejecutar la consulta
if ($conexion->query($sql) === TRUE) {
    echo "Se actualizó el jugador con idJugador = $idJugador. El equipo se estableció en NULL.";
} else {
    echo "Error al actualizar el jugador: " . $conexion->error;
}

// Cerrar la conexión
$conexion->close();

echo '<h1>El jugador ha sido despidio</h1>';
// Redirige a la página principal o a donde desees después del UPDATE
header('Location: ../index.php?vista=jugador_list');
exit();
?>
