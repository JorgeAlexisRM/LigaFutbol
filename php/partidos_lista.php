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
    $fotoA="";
    $marcadorA="";

    $equipoB="";
    $fotoB="";
    $marcadorB="";
    
    $n =0;

    $nPartidos = count($datos);
    $contador=0;

    foreach($datos as $dato){
        foreach($equipos as $equipo){
            if($dato['equipolocal']==$equipo['idEquipo']){
                $equipoA = $equipo['nombre'];
                if(is_file("./img/equipos/".$equipo['foto'])){
                    $fotoA='<img src="./img/equipos/'.$equipo['foto'].'">';
                }else{
                    $fotoA='<img src="./img/equipo.png">';
                }
            }else{
                if($dato['equipolocal']=='DESCANSO'){
                    $equipoA = 'DESCANSO';
                    $fotoA='';
                }
            }

            if($dato['equipoVisitante']==$equipo['idEquipo']){
                $equipoB = $equipo['nombre'];
                if(is_file("./img/equipos/".$equipo['foto'])){
                    $fotoB='<img src="./img/equipos/'.$equipo['foto'].'">';
                }else{
                    $fotoB='<img src="./img/equipo.png">';
                }
            }else{
                if($dato['equipoVisitante']=='DESCANSO'){
                    $equipoB = 'DESCANSO';
                    $fotoB='';
                }
            }
        }

        if($n != $dato['jornada']){
            $n+=1;
            $item.='<h1 class="titulo"> Jornada '  . $n . '</h1>';
        }
        $item .= '<div class="item">
            '.$fotoA.'
            <label>'.$equipoA.'</label> 
            <label>vs</label> 
            <label>'. $equipoB.'</label>
            '.$fotoB.'
            <br>';
        if($equipoA==='DESCANSO' || $equipoB==='DESCANSO'){
            $item .= '';
        }else{
            $item .= '<label>'.$dato['marcadorLocal'].'</label>
                <label>'.$dato['marcadorVisitante'].'</label>';
        }

        if (isset($_SESSION['usuario'])&&($_SESSION['rol']=='administrador')) {
            $item .= '<a href="index.php?vista=marcador&idPartido='.$dato['idPartido'].'">
                    Editar Marcador
                </div></a>';
        }else{
            $item .= '</div>';
        }
        
        /**contador de partidos jugados */
        if($dato['jugado']==1){
            $contador+=1;
        }
    }

    /**Verificando si ya se jugaron todos los partidos */
    if($contador===$nPartidos){
        echo '<div class="respuesta">
            <label>Se han jugado todos los partidos</label>
            <button>Terminar Torneo</button>
        </div>';
    }

    $conexion=null;
    echo $item;