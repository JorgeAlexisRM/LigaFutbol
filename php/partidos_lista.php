<?php
    $consulta_datos = "SELECT * FROM partidos";
    $consulta_equipos = "SELECT * FROM equipos";

	$conexion = conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

    $equipos=$conexion->query($consulta_equipos);
    $equipos=$equipos->fetchAll();

    $item = "";
    $equipoA="";
    $equipoB="";
    $n =0;

    foreach($datos as $dato){
        foreach($equipos as $equipo){
            if($dato['equipolocal']==$equipo['idEquipo']){
                $equipoA = $equipo['nombre'];
            }else{
                if($dato['equipolocal']=='DESCANSO'){
                    $equipoA = 'DESCANSO';
                }
            }
            if($dato['equipoVisitante']==$equipo['idEquipo']){
                $equipoB = $equipo['nombre'];
            }else{
                if($dato['equipoVisitante']=='DESCANSO'){
                    $equipoB = 'DESCANSO';
                }
            }
        }

        if($n != $dato['jornada']){
            $n+=1;
            $item.='<h1 class="titulo"> Jornada '  . $n . '</h1>';
        }
        $item .= '<div class="item">
            <label>'.$equipoA.'</label> 
            <label>vs</label> 
            <label>'. $equipoB.'</label>
            </div>';
        
    }

    $conexion=null;
    echo $item;