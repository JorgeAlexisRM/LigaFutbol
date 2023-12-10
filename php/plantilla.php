<?php
    $idEquipo=$_GET['idEquipo'];

    $consulta_datos = "SELECT * FROM jugadores";
    $consulta_equipos = "SELECT * FROM equipos WHERE idEquipo='$idEquipo'";
    //echo $consulta_equipos;

	$conexion = conexion();

	$jugadores = $conexion->query($consulta_datos);
	$jugadores = $jugadores->fetchAll();

    $equipos=$conexion->query($consulta_equipos);
    

    $item = "";
    $equipo="";
    $ima="";
    
    $n =0;
    if($equipos->rowCount()==1){

    	$equipos=$equipos->fetch();
        $equipo=$equipos['nombre'];
        $item.='<h1 class="titulo">'  . $equipo . '</h1>';

        foreach($jugadores as $dato){
            if ($dato['equipo']==$idEquipo){
                $n+=1;
                if(is_file("./img/equipos/".$equipos['foto'])){
                    $ima=' <img src="./img/equipos/'.$equipos['foto'].'">';
                }else{
                    $ima=' <img src="./img/equipo.png">';
                }
                $item .= '<div class="item">
            <label>'.$n.'</label> 
            '.$ima.'
            <label>'.$dato['nombre'].'</label> 
            <label>'.$dato['posicion'].'</label>
            <label>'.$dato['edad'].'</label>
            <label>'.$dato['camiseta'].'</label>
            <a href=\'index.php?vista=infoJugador&idEquipo='.$idEquipo.'&idJugador='.$dato['idJugador'].'\'>ver</a>
            </div>';
            }
        }   
    }else{
        $item.='<h1 class="titulo">Ocurrio algun error y no hay equipo que mostrar</h1>';
    }

    $conexion=null;
    echo $item;
?>