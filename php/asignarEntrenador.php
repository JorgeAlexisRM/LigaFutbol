<?php
require_once "main.php";

$conexion = conexion();
$consultaEquipos = $conexion->query("SELECT * FROM equipos");
$equipos = $consultaEquipos->fetchAll();

$idEntrenador=$_POST['idEntrenador'];
$nombre =$_POST['equipo'];

$actualizar_equipo=conexion();
$actualizar_equipo=$actualizar_equipo->prepare("UPDATE equipos SET idEntrenador=:entrenador WHERE idEquipo=:idEquipo");


foreach($equipos as $equipo){
    if($equipo['nombre']==$nombre){
        $marcadores=[
            ":entrenador"=>$idEntrenador,
            ":idEquipo"=>$equipo['idEquipo']
        ];
    }
}

if($actualizar_equipo->execute($marcadores)){
    echo '
        <div class="notification is-info is-light">
            <strong>¡EQUIPO ACTUALIZADO!</strong><br>
            Los datos se han actualizado con exito
        </div>
    ';
}else{
    echo '
        <div class="notification is-danger is-light">
            <strong>¡Ocurrio un error inesperado!</strong><br>
            No se pudo asignar el entrenador al equipo, por favor intente nuevamente
        </div>
    ';
}