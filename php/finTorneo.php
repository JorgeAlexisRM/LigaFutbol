<?php
    require_once "main.php";

    $conexion=conexion();

    $consulta = "SELECT * FROM equipos";

    $equipos = $conexion->query($consulta);
	$equipos = $equipos->fetchAll();
    $campeon="";
    $pts=0;
    $dg=0;

    foreach($equipos as $equipo){
        if($equipo['puntos']==$pts){
            $goles=$equipo['afavor']-$equipo['contra'];
            if($dg<(abs($goles))){
                $campeon=$equipo['nombre'];
                $dg=abs($goles);
            }
        }elseif($equipo['puntos']>$pts){
            $campeon=$equipo['nombre'];
            $pts=$equipo['puntos'];
            $dg=abs($equipo['afavor']-$equipo['contra']);
        }
    }

    $consulta="SELECT * FROM torneos";
    $torneos = $conexion->query($consulta);
    $torneos=$torneos->fetchAll();

    $actualizar_torneo=conexion();
    $actualizar_torneo=$actualizar_torneo->prepare("UPDATE torneos SET enjuego=:enjuego,campeon=:campeon WHERE idTorneo=:idTorneo");

    foreach($torneos as $torneo){
        if($torneo['enjuego']==0){
            $marcadores=[
                ":enjuego"=>1,
                ":campeon"=>$campeon,
                ":idTorneo"=>$torneo['idTorneo']
            ];
        }
    }

    if($actualizar_torneo->execute($marcadores)){
        echo '
            <div class="notification is-info is-light">
                <strong>¡TORNEO FINALIZADO!</strong><br>
                El torneo concluyó felicidades al campeón '.$campeon.'
            </div>
        ';

        $consulta="DELETE FROM partidos";
        $conexion->query($consulta);

    }else{
        echo '
            <div class="notification is-danger is-light">
                <strong>¡Ocurrio un error inesperado!</strong><br>
                No se pudo finalizar el torneo, por favor intente nuevamente
            </div>
        ';
    }

    /**Reiniciar equipos */
    $consulta="SELECT * FROM equipos";
    $equipos = $conexion->query($consulta);
	$equipos = $equipos->fetchAll();

    $actualizar_equipos=conexion();
    $actualizar_equipos=$actualizar_equipos->prepare("UPDATE equipos SET afavor=:afavor,contra=:contra, empatados=:empatados, ganados=:ganados, perdidos=:perdidos, puntos=:puntos WHERE idEquipo=:idEquipo");

    foreach($equipos as $equipo){
            /**Equipo local */
        $marcadores=[
            ":afavor"=>0,
            ":contra"=>0,
            ":empatados"=>0,
            ":ganados"=>0,
            ":puntos"=>0,
            ":perdidos"=>0,
            ":idEquipo"=>$equipo['idEquipo']
        ];
        $actualizar_equipos->execute($marcadores);
    }

    $conexion=null;
    $actualizar_torneo=null;
    $actualizar_equipos=null;

