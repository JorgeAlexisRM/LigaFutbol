<?php
require_once "main.php";

// Obtén el idJugador desde la URL
$idJugador = $_POST['idJugador'];
$idEquipo = $_POST['idEquipo'];
$camiseta = (int) $_POST['camiseta'];
$conexion=conexion();
echo $camiseta;
$consulta = $conexion->query("SELECT * FROM jugadores WHERE equipo='$idEquipo'");

if($consulta->rowCount()<1){
    $marcadores=[
        ":equipo"=>$idEquipo,
        ":camiseta"=>$camiseta,
        ":idJugador"=>$idJugador
    ];
}

$consulta=$consulta->fetchAll();
$actualizar_jugador=$conexion->prepare("UPDATE jugadores SET equipo=:equipo,camiseta=:camiseta WHERE idJugador=:idJugador");

foreach ($consulta as $equipo) {
    $aux=(int)$equipo['camiseta'];
    if($aux===$camiseta){
        echo  '<h1>Esa camiseta esta ocupada, elige otra</h1>';
    }else{
        $marcadores=[
            ":equipo"=>$idEquipo,
            ":camiseta"=>$camiseta,
            ":idJugador"=>$idJugador
        ];
    }
}

if($actualizar_jugador->execute($marcadores)){
    echo '
        <div class="notification is-info is-light">
            <strong>¡JUGADOR ACTUALIZADO!</strong><br>
            Los datos se han actualizado con exito
        </div>
    ';
}else{
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No se pudo actualizar los datos del jugador, por favor intente nuevamente
        </div>
    ';
}