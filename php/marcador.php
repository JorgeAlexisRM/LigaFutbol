<?php
    require_once "main.php";

    $idPartido=$_GET['idPartido'];

    $consulta_datos = "SELECT * FROM partidos";
    $consulta_equipos = "SELECT * FROM equipos";

    $conexion = conexion();

	$partidos = $conexion->query($consulta_datos);
	$partidos = $partidos->fetchAll();

    $item='';
    $equipoLocal="";
    $equipoVisitante="";

    foreach($partidos as $partido){
        if($partido['idPartido']==$idPartido){
            if($partido['jugado']==1){
                echo '<p>Partido Jugado o de descanso</p>';
            }else{

                $equipos = $conexion->query($consulta_equipos);
                $equipos = $equipos->fetchAll();

                foreach($equipos as $equipo){
                    if($partido['equipolocal']==$equipo['idEquipo']){
                        $equipoLocal = $equipo['nombre'];
                    }

                    if($partido['equipoVisitante']==$equipo['idEquipo']){
                        $equipoVisitante = $equipo['nombre'];
                    }

                }

                $item.='<form action="./php/actualizar_marcador.php" class="FormularioAjax" method="POST" autocomplete="off" enctype="multipart/form-data" >
                    <div class="idPartido">
                        <input name="idPartido" type="text" value="'.$idPartido.'" readonly>
                    </div
                    <div class="equipoNombre">
                        <label>Equipo Local: </label>
                        <input name="equipoLocal" type="text" value="'.$equipoLocal.'" readonly>
                    </div>
                    <div class="equipoNombre">
                        <label>Equipo Visitante: </label>
                        <input name="equipoVisitante" type="text" value="'.$equipoVisitante.'" readonly>
                    </div>
                    <div class="marcador">
                        <input name="marcadorLocal" type="number">
                    </div>
                    <div class="marcador">
                        <input name="marcadorVisitante" type="number">
                    </div>
                    <p>
                        <button type="submit">Actualizar Marcador</button>
                    </p>
                    </form>
                ';
            }
        }
    }
    $conexion = null;

    echo $item;