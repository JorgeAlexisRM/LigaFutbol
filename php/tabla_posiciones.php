<?php
$consulta_datos = "SELECT *,(ganados + 
empatados + perdidos) AS 
partidos_jugados FROM equipos";

$conexion = conexion();

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();

usort($datos, function ($a, $b) {
    if ($a['puntos'] != $b['puntos']) {
        return $b['puntos'] - $a['puntos'];
    } else {
        return ($b['afavor'] - $b['contra']) - ($a['afavor'] - $a['contra']);
    }
});
?>

<table>
    <tr>
        <th>Posición</th>
        <th>Nombre del Equipo</th>
        <th>Partidos Jugados</th>
        <th>Partidos Ganados</th>
        <th>Partidos Empatados</th>
        <th>Partidos Perdidos</th>
        <th>Goles a Favor</th>
        <th>Goles en Contra</th>
        <th>Diferencia de Goles</th>
        <th>Puntos Generales</th>
    </tr>
    <?php
    $posicion = 1;
    foreach ($datos as $dato) {
        echo "<tr>";
        echo "<td>" . $posicion . "</td>";
        echo "<td>" . $dato['nombre'] . "</td>";
        echo "<td>" . $dato['partidos_jugados'] . "</td>";
        echo "<td>" . $dato['ganados'] . "</td>";
        echo "<td>" . $dato['empatados'] . "</td>";
        echo "<td>" . $dato['perdidos'] . "</td>";
        echo "<td>" . $dato['afavor'] . "</td>";
        echo "<td>" . $dato['contra'] . "</td>";
        echo "<td>" . ($dato['afavor'] - $dato['contra']) . "</td>";
        echo "<td>" . $dato['puntos'] . "</td>";
        echo "</tr>";
        $posicion++;
    }
    ?>
</table>

<?php
$conexion = null;
?>
