<?php

$consulta_datos = "SELECT * FROM equipos";

$conexion = conexion();

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();
$equipos=array();
$foto='./img/equipo.png';

foreach($datos as $dato){
    if(is_file("./img/equipos/".$dato['foto'])){
        $foto = './img/equipos/'.$dato['foto'];
    }else{
        $foto='./img/equipo.png';
    }
    $equipos[]= array($dato['nombre'],$foto);
}
$conexion=null;

$nEquipos = count($equipos);

if ($nEquipos % 2 == 0) {

} else {

    $nEquipos += 1;
    $equipos[]= array("DESCANSO","./img/equipo.png");
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

$partidos="";

$A=0;
$B=0;
$n = 0;
$i = 0;
$j = 0;
$equipoAux = [];
while ($n < ($nEquipos - 1)) {
    $partidos.='<h1 class="titulo"> Jornada '  . ($n + 1) . '</h1>';

    while ($i < ($nEquipos / 2)) {

        $A=$equiposA[$i];
        $B=$equiposB[$j];

        $partidos.='<div class="item">
            <img src="'.$equipos[$A][1].'">
            <label>'.$equipos[$A][0].'</label> 
            <label>vs</label> 
            <label>'. $equipos[$B][0].'</label>
            <img src="'.$equipos[$B][1].'">
            </div>';

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

echo $partidos;