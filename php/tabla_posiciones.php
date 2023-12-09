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
        return ($b['afavor'] - $b['contra']) -
            ($a['afavor'] - $a['contra']);
    }
});
?>

<div class="table-container">
    <table class="tbody1">
         <tr><th>Temporada</th></tr>
    </table>
    <table class="tbody">
        <tr>
            <th></th>
            <th id="Club">Club</th>
            <th>PJ</th>
            <th>PG</th>
            <th>PE</th>
            <th>PP</th>
            <th>GF</th>
            <th>GC</th>
            <th>DG</th>
            <th>Pts</th>
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
</div>
<?php
$conexion = null;
?>