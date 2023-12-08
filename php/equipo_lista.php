<?php
    $consulta_datos = "SELECT * FROM equipos";

	$conexion = conexion();

	$datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();
    $item = "";

    foreach($datos as $dato){
        if(is_file("./img/equipos/".$dato['foto'])){
            $item.='<div class="item"> <img src="./img/equipos/'.$dato['foto'].'">';
        }else{
            $item.='<div class="item"> <img src="./img/equipo.png">';
        }
        $item .= '<label> '.$dato['nombre'].' </label>
            </div>';
        
    }

    $conexion=null;
    echo $item;