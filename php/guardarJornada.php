<?php

require_once "../inc/session_start.php";

require_once "main.php";

$consulta_datos = "SELECT * FROM equipos";

$conexion = conexion();

$datos = $conexion->query($consulta_datos);
$datos = $datos->fetchAll();
$equipos=array();

foreach($datos as $dato){
    $equipos[]= $dato['idEquipo'];
}

$conexion=null;

$nEquipos = count($equipos);

if ($nEquipos % 2 == 0) {

} else {

    $nEquipos += 1;
    $equipos[]= "DESCANSO";
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

$A=0;
$B=0;
$n = 0;
$i = 0;
$j = 0;
$equipoAux = [];

$guardar_partido=conexion();
$guardar_partido=$guardar_partido->prepare("INSERT INTO partidos(idPartido,jornada,equipolocal,equipoVisitante,jugado,marcadorLocal,marcadorVisitante) VALUES(:idPartido,:jornada,:equipolocal,:equipoVisitante,:jugado,:marcadorLocal,:marcadorVisitante)");


while ($n < ($nEquipos - 1)) {
    /**Nueva Jornada */

    while ($i < ($nEquipos / 2)) {
        $codigo = uniqid("partido");
        $A=$equiposA[$i];
        $B=$equiposB[$j];

        $marcadores=[
            ":idPartido"=>$codigo,
            ":jornada"=>$n+1,
            ":equipolocal"=>$equipos[$A],
            ":equipoVisitante"=>$equipos[$B],
            ":jugado"=>0,
            ":marcadorLocal"=>0,
            ":marcadorVisitante"=>0
        ];

        print_r($marcadores);

        $guardar_partido->execute($marcadores);

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

if($guardar_partido->rowCount()>0){
    echo '
        <div class="notification is-info is-light">
            <strong>¡PARTIDO REGISTRADO!</strong><br>
            El partido se registro con exito
        </div>
    ';
    }else{

    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No se pudo registrar el partido, por favor intente nuevamente
        </div>
    ';
    }

$guardar_partido=null;