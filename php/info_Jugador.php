<?php
    $idEquipo=$_GET['idEquipo'];
    $idJugador=$_GET['idJugador'];

    $consulta_datos = "SELECT * FROM jugadores WHERE idJugador='$idJugador'";
    $consulta_equipos = "SELECT * FROM equipos WHERE idEquipo='$idEquipo'";
    //echo $consulta_equipos;

	$conexion = conexion();

	$jugador = $conexion->query($consulta_datos);

    $equipos=$conexion->query($consulta_equipos);
    

    $item = "";
    $equipo="";
    $ima="";
    
    $n =0;
    if($equipos->rowCount()==1){

    	$equipos=$equipos->fetch();

        if(is_file("./img/equipos/".$equipos['foto'])){
            $item.=' <img  class="imagenEqui" src="./img/equipos/'.$equipos['foto'].'">';
        }else{
            $item.=' <img class="imagenEqui" src="./img/equipo.png">';
        }

        if($jugador->rowCount()==1){
            $jugador = $jugador->fetch();
            $item.='<label class="nombreJu">'.$jugador['nombre'].' '.$jugador['apellido'].'</label>';
                $n+=1;
                $item .= '<div class="item">
            <label>'.$jugador['posicion'].'</label>
            <label>'.$jugador['edad'].' años'.'</label>        
            <a href="./php/despedir.php?idJugador='.$jugador['idJugador'].'">Despedir</a>
            </div>';
            
        }   
    }else{
        if($jugador->rowCount()==1){
            $jugador = $jugador->fetch();
            $item.='<label class="nombreJu">'.$jugador['nombre'].' '.$jugador['apellido'].'</label>';
                $n+=1;
                $item .= '<div class="item">
            <label>'.$jugador['edad'].' años'.'</label>
            <a href="./php/transferir.php?idJugador='.$jugador['idJugador'].'">Transferir</a>
            </div>';
            
        } 
    }
} else {
    $item .= ' <img class="imagenEqui" src="./img/equipo.png">';
    if ($jugador->rowCount() == 1) {
        $jugador = $jugador->fetch();
        $item .= '<label class="nombreJu">' . $jugador['nombre'] . ' ' . $jugador['apellido'] . '</label>';
        $item .= '<div class="item">
                <label>' . $jugador['posicion'] . '</label>
                <label>' . $jugador['edad'] . ' años' . '</label>
                <a href="index.php?vista=transferencias.php&idJugador=' .$idJugador . '">Transferir</a>
                </div>';
    }
}   
    echo $item;

    
?>