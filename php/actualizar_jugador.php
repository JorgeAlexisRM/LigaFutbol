<?php
	require_once "main.php";

    $idJugador=$_POST['idJugador'];
    $edad=$_POST['edad'];
    $posicion=$_POST['posicion'];

    /*== Actualizando partido ==*/
    $actualizar_jugador=conexion();
    $actualizar_jugador=$actualizar_jugador->prepare("UPDATE jugadores SET edad=:edad,posicion=:posicion WHERE idJugador=:idJugador");

    $marcadores=[
        ":edad"=>$edad,
        ":posicion"=>$posicion,
        ":idJugador"=>$idJugador
    ];

    if($actualizar_jugador->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡JUGADOR ACTUALIZADO!</strong><br>
                Los datos se han actualizado con exito
            </div>
        ';
        $_SESSION['posicion']=$posicion;
        $_SESSION['edad']=$edad;
    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo actualizar los datos del jugador, por favor intente nuevamente
            </div>
        ';
    }
    $actualizar_jugador=null;