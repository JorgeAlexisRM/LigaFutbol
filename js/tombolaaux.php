<?php

$consulta_datos = "SELECT * FROM equipos";

$conexion = conexion();

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();
$equipos=array();

foreach($datos as $dato){
    $equipos[]= $dato['nombre'];
}
$conexion=null;

$nEquipos = count($equipos);

if ($nEquipos % 2 == 0) {
    echo "Es par\n";
} else {
    echo "Es impar\n";
    $nEquipos += 1;
    $equipos[]="descanso";
}

$equiposA = [];
$equiposB = [];

$i = 0;
$n = $nEquipos - 1;
while ($i < $n) {
    $equiposA[] = $i;
    $equiposB[] = $n;
    $i += 1;
    $n -= 1;
}

print_r($equiposA);
print_r($equiposB);
$A=0;
$B=0;
$n = 0;
$i = 0;
$j = 0;
$equipoAux = [];
while ($n < ($nEquipos - 1)) {
    echo "Jornada " . ($n + 1) . "\n";
    while ($i < ($nEquipos / 2)) {
        echo $equiposA[$i] . " " . $equiposB[$j] . "\n";
        $A=$equiposA[$i];
        $B=$equiposB[$j];
        echo $equipos[$A] . " vs " . $equipos[$B]. "\n";
        $j += 1;
        $i += 1;
    }
    $i = floor($nEquipos / 2) - 1;
    $equipoAux = $equiposB[0];
    array_shift($equiposB);
    $aux = $equiposA[$i];
    $equiposB[] = $aux;
    array_splice($equiposA, $i, 1);
    array_splice($equiposA, 1, 0, $equipoAux);
    $j = 0;
    $i = 0;
    $n += 1;
}
?>
